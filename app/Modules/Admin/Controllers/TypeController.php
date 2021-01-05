<?php

namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Memcache;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;
use App\Modules\Models\Trash;
use App\Modules\Models\Type;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class TypeController extends BaseAdminController{
    private $arrStatus = array(-1 => 'Chọn', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $error = '';

    public function __construct(){
        parent::__construct();
        Loader::loadJS('backend/js/admin.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/jAlert/jquery.alerts.css', CGlobal::$postHead);
        Loader::loadJS('libs/jAlert/jquery.alerts.js', CGlobal::$postEnd);
    }

    public function listView(){
        $pageNo = (int)Request::get('page', 1);
        $pageScroll = CGlobal::num_scroll_page;
        $limit = 10;
        $offset = ($pageNo - 1)*$limit;
        $total = 0;
        $search = $data = array();

        $search['type_title'] = addslashes(Request::get('type_title', ''));
        $search['type_status'] = (int)Request::get('type_status', -1);
        $search['submit'] = (int)Request::get('submit', 0);
        $search['field_get'] = '';

        $dataSearch = Type::searchByCondition($search, $limit, $offset, $total);
        $paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';

        $optionStatus = Utility::getOption($this->arrStatus, $search['type_status']);
        $messages = Utility::messages('messages');

        return view('Admin::type.list',[
            'data' => $dataSearch,
            'total' => $total,
            'search' => $search,
            'paging' => $paging,
            'optionStatus' => $optionStatus,
            'arrStatus' => $this->arrStatus,
            'messages' => $messages
        ]);
    }

    public function getItem($id = 0){
        $data = array();

        if ($id > 0){
            $data = Type::getById($id);
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['type_status']) ? $data['type_status'] : CGlobal::status_show);

        return view('Admin::type.add',[
            'id' => $id,
            'data' => $data,
            'optionStatus' => $optionStatus,
            'error' => $this->error
        ]);
    }

    public function postItem($id = 0){
        $data = array();
        $id_hiden = (int)Request::get('id_hiden', 0);

        $dataSave = array(
            'type_title' => array('value' => addslashes(Request::get('type_title')), 'require' => 1, 'messages' => 'Tiêu đề không được trống!'),
            'type_keyword' => array('value' => addslashes(Request::get('type_keyword')), 'require' => 1, 'messages' => 'Từ khóa không được trống!'),
            'type_intro' => array('value' => addslashes(Request::get('type_intro')), 'require' => 0),
            'type_order_no' => array('value' => (int)Request::get('type_order_no'), 'require' => 0 ),
            'type_created' => array('value' => time()),
            'type_status' => array('value' => (int)Request::get('type_status', -1), 'require' => 0)
        );

        if ($id > 0){
            unset($dataSave['type_created']);
        }

        //Hiện lỗi
        $this->error = ValidForm::validInputData($dataSave);
        if ($this->error == ''){
            $id = ($id == 0) ? $id_hiden : $id;
            Type::saveData($id, $dataSave);
            return Redirect::route('admin.type');
        }
        else{
            foreach ($dataSave as $key => $val){
                $data[$key] = $val['value'];
            }
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['type_status']) ? $data['type_status'] : -1);

        return view('Admin::type.add',[
            'id' => $id,
            'data' => $data,
            'optionStatus' => $optionStatus,
            'error' => $this->error
        ]);
    }

    public function delete(){
        $listId = Request::get('checkItem', array());
        $token = Request::get('_token', '');

        if (Session::token() === $token){
            if (is_array($listId) && !empty($listId)){
                foreach ($listId as $id){
                    Trash::addItem($id, 'Type', '', 'type_id', 'type_title', '', '');
                    Type::deleteId($id);
                }
                Utility::messages('messages', 'Xóa thành công!');
            }
        }
        return Redirect::route('admin.type');
    }

    public static function getIdByKeyword($keyword=''){
        $id = 0;
        $result = (Memcache::CACHE_ON) ? Cache::get(Memcache::CACHE_TYPE_KEYWORD.$keyword) : array();
        try {
            if(empty($result)){
                $result = Type::where('type_keyword', $keyword)->first();
                if($result && Memcache::CACHE_ON){
                    Cache::put(Memcache::CACHE_TYPE_KEYWORD.$keyword, $result, Memcache::CACHE_TIME_TO_LIVE_ONE_MONTH);
                }
            }
            if(!empty($result)){
                $id = $result->type_id;
            }
        } catch (PDOException $e) {
            throw new PDOException();
        }
        return $id;
    }

    public static function getArrType(){
        $result = array(-1 => 'Chọn kiểu danh mục');
        $dataSearch['field_get'] = 'type_id,type_title';
        $arrType = Type::getAllType($dataSearch, $limit = 1000);
        if (!empty($arrType)){
            foreach ($arrType as $cate){
                $result[$cate->type_id] = $cate->type_title;
            }
        }
        return $result;
    }
}

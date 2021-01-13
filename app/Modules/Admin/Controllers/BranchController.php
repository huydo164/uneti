<?php

namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;
use App\Modules\Models\Branch;
use App\Modules\Models\Trash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class BranchController extends BaseAdminController{
    private $arrStatus = array(-1 => 'Chọn', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $error = '';

    public function __construct()
    {
        parent::__construct();
        Loader::loadJS('backend/js/admin.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/jAlert/jquery.alerts.css', CGlobal::$postHead);
        Loader::loadJS('libs/jAlert/jquery.alerts.js', CGlobal::$postEnd);
    }

    public function listView(){
        $pageNo = (int)Request::get('page', 1);
        $pageScroll = CGlobal::num_scroll_page;
        $limit = CGlobal::num_record_per_page;
        $offset = ($pageNo - 1)*$limit;
        $search = $data = array();
        $total = 0;

        $search['branch_name'] = addslashes(Request::get('branch_name', ''));
        $search['branch_status'] = (int)Request::get('branch_status', -1);
        $search['submit'] = (int)Request::get('submit', 0);
        $search['field_get'] = '';

        $dataSearch = Branch::searchByCondition($search, $limit, $offset, $total);
        $paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';

        $optionStatus = Utility::getOption($this->arrStatus, $search['branch_status']);
        $messages = Utility::messages('messages');

        return view('Admin::branch.list',[
            'data' => $dataSearch,
            'search' => $search,
            'total' => $total,
            'paging' => $paging,
            'optionStatus' => $optionStatus,
            'arrStatus' => $this->arrStatus,
            'messages' => $messages
        ]);
    }

    public function getItem($id = 0){
        Loader::loadJS('libs/ckeditor/ckeditor.js', CGlobal::$postHead);
        $data = array();

        if($id > 0){
            $data = Branch::getById($id);
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['branch_status']) ? $data['branch_status'] : CGlobal::status_show);

        return view('Admin::branch.add',[
            'id' => $id,
            'data' => $data,
            'optionStatus' => $optionStatus,
            'error' => $this->error,
        ]);
    }

    public function postItem($id = 0){
        Loader::loadJS('libs/ckeditor/ckeditor.js', CGlobal::$postHead);
        $data = array();
        $id_hiden = (int)Request::get('id_hiden', 0);

        $dataSave = array(
            'branch_name' => array('value' => addslashes(Request::get('branch_name')), 'require' => 1, 'messages', 'Tên ngành không được trống!'),
            'branch_created' => array('value' => time()),
            'branch_id_project' => array('value' => (int)Request::get('branch_id_project', - 1), 'require' => 0),
            'branch_id_sv' => array('value' => (int)Request::get('branch_id_sv', - 1), 'require' => 0),
            'branch_status' => array('value' => (int)Request::get('branch_status', -1), 'require' => 0)
        );

        if ($id > 0){
            unset($dataSave['branch_created']);
        }

        //Hiện lỗi
        $this->error = ValidForm::validInputData($dataSave);
        if ($this->error == ''){
            $id = ($id == 0) ? $id_hiden : $id;
            Branch::saveData($id, $dataSave);
            return Redirect::route('admin.branch');
        }
        else{
            foreach ($dataSave as $key => $value){
                $data[$key] = $value['value'];
            }
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['branch_status']) ? $data['branch_status'] : CGlobal::status_show);

        return view('Admin::branch.add',[
            'id' => $id,
            'data' => $data,
            'optionStatus' => $optionStatus,
        ]);
    }

    public function delete(){
        $checkId = Request::get('checkItem', array());
        $token = Request::get('_token', '');

        if (Session::token() === $token){
            if (is_array($checkId) && !empty($checkId)){
                foreach ($checkId as $id){
                    Trash::addItem($id, 'Branch', CGlobal::FOLDER_BRANCH, 'branch_id', 'branch_name', '', '');
                    Branch::deleteId($id);
                }
                Utility::messages('messages', 'Xóa thành công!', 'success');
            }
        }
        return Redirect::route('admin.branch');
    }
}
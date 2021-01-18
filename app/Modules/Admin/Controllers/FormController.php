<?php

namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;
use App\Modules\Models\Form;
use App\Modules\Models\Trash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class FormController extends BaseAdminController{
    private $arrStatus = array(-1 => 'Chọn', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $error = '';

    public function __construct()
    {
        parent::__construct();
        Loader::loadJS('backend/js/admin.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/upload/cssUpload.css', CGlobal::$postHead);
        Loader::loadJS('libs/upload/jquery.uploadfile.js', CGlobal::$postEnd);
        Loader::loadJS('backend/js/upload-admin.js', CGlobal::$postEnd);
        Loader::loadJS('libs/dragsort/jquery.dragsort.js', CGlobal::$postHead);
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

        $search['form_title'] = addslashes(Request::get('form_title', ''));
        $search['form_status'] = (int)Request::get('form_status', -1);
        $search['submit'] = (int)Request::get('submit', 0);
        $search['field_get'] = '';

        $dataSearch = Form::searchByCondition($search, $limit, $offset, $total);
        $paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';

        $optionStatus = Utility::getOption($this->arrStatus, $search['form_status']);
        $messages = Utility::messages('messages');

        return view('Admin::form.list',[
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
            $data = Form::getById($id);
            if ($data != ''){
                if(Request::hasFile('file')){

                    $file = Request::file('file');
                    $filename = $file->getClientOriginalName();
                    $path = public_path().'/uploads/';
                    return $file->move($path, $filename);
                }
            }
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['form_status']) ? $data['form_status'] : CGlobal::status_show);

        return view('Admin::form.add',[
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
            'form_title' => array('value' => addslashes(Request::get('form_title')), 'require' => 1, 'messages', 'Tên ngành không được trống!'),
            'form_created' => array('value' => time()),
            'form_order_no' => array('value' => (int)Request::get('form_order_no', - 1), 'require' => 0),
            'form_status' => array('value' => (int)Request::get('form_status', - 1), 'require' => 0),
        );



        $image_primary = addslashes(Request::get('image_primary', ''));
        $dataSave['image_primary']['value'] = ($image_primary != '') ? $image_primary : '';


        if ($id > 0){
            unset($dataSave['form_created']);
        }

        //Hiện lỗi
        $this->error = ValidForm::validInputData($dataSave);
        if ($this->error == ''){
            $id = ($id == 0) ? $id_hiden : $id;
            Form::saveData($id, $dataSave);
            return Redirect::route('admin.form');
        }
        else{
            foreach ($dataSave as $key => $value){
                $data[$key] = $value['value'];
            }
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['form_status']) ? $data['form_status'] : CGlobal::status_show);

        return view('Admin::form.add',[
            'id' => $id,
            'data' => $data,
            'news_form' => $image_primary,
            'error' => $this->error,
            'optionStatus' => $optionStatus,
        ]);
    }

    public function delete(){
        $checkId = Request::get('checkItem', array());
        $token = Request::get('_token', '');

        if (Session::token() === $token){
            if (is_array($checkId) && !empty($checkId)){
                foreach ($checkId as $id){
                    Trash::addItem($id, 'Form', CGlobal::FOLDER_FORM, 'form_id', 'form_title', '', '');
                    Form::deleteId($id);
                }
                Utility::messages('messages', 'Xóa thành công!', 'success');
            }
        }
        return Redirect::route('admin.form');
    }
}
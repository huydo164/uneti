<?php

namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;
use App\Modules\Models\Contact;
use App\Modules\Models\Trash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends BaseAdminController{
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

        $search['contact_name'] = addslashes(Request::get('contact_name', ''));
        $search['contact_status'] = (int)Request::get('contact_status', -1);
        $search['submit'] = (int)Request::get('submit', 0);
        $search['field_get'] = '';

        $dataSearch = Contact::searchByCondition($search, $limit, $offset, $total);
        $paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';

        $optionStatus = Utility::getOption($this->arrStatus, $search['contact_status']);
        $messages = Utility::messages('messages');

        return view('Admin::contact.list',[
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
            $data = Contact::getById($id);
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['contact_status']) ? $data['contact_status'] : CGlobal::status_show);

        return view('Admin::contact.add',[
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
            'contact_name' => array('value' => addslashes(Request::get('contact_name')), 'require' => 1, 'messages', 'Tên không được trống!'),
            'contact_phone' => array('value' => addslashes(Request::get('contact_phone')), 'require' => 0),
            'contact_content' => array('value' => addslashes(Request::get('contact_content')), 'require' => 0),
            'contact_created' => array('value' => time()),
            'contact_status' => array('value' => (int)Request::get('contact_status'))
        );

        if ($id > 0){
            unset($dataSave['contact_created']);
        }

        //Hiện lỗi
        $this->error = ValidForm::validInputData($dataSave);
        if ($this->error == ''){
            $id = ($id == 0) ? $id_hiden : $id;
            Contact::saveData($id, $dataSave);
            return Redirect::route('admin.contact');
        }
        else{
            foreach ($dataSave as $key => $value){
                $data[$key] = $value['value'];
            }
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['contact_status']) ? $data['contact_status'] : -1);

        return view('Admin::contact.add',[
            'id' => $id,
            'data' => $data,
            'optionStatus' => $optionStatus,
            'error' => $this->error
        ]);
    }

    public function delete(){
        $checkId = Request::get('checkItem', array());
        $token = Request::get('_token', '');

        if (Session::token() === $token){
            if (is_array($checkId) && !empty($checkId)){
                foreach ($checkId as $id){
                    Trash::addItem($id, 'Contact', CGlobal::FOLDER_CONTACT, 'contact_id', 'contact_title', 'contact_image', '');
                    Contact::deleteId($id);
                }
                Utility::messages('messages', 'Xóa thành công!', 'success');
            }
        }
        return Redirect::route('admin.contact');
    }
}

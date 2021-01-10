<?php

namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;
use App\Modules\Models\Sinhvien;
use App\Modules\Models\Trash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class SinhvienController extends BaseAdminController{
    private $arrStatus = array(-1 => 'Chọn', CGlobal::status_hide => 'Chưa duyệt', CGlobal::status_show => 'Đã duyệt');
    private $arrFocus = array(-1 => 'Chọn', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $school = array(-1 => 'Chọn', 1 => 'Trường Đại học kinh tế kỹ thuật công nghiệp');
    private $arrGender  = array(-1 => 'Chọn giới tính', 1 => 'Nam', 2 => 'Nữ');
    private $arrTrainSystem = array(
            -1 => 'Chọn hệ đào tạo',
            1 => 'Đại học',
            2 => 'Cao đẳng'
    );
    private $arrCareer = array(
        -1 => 'Chọn ngành',
        1 => 'Công nghệ thông tin',
        2 => 'Điện tử điện lạnh',
        3 => 'Tự động hóa',
        4 => 'Quản trị kinh doanh',
        5 => 'Tài chính ngân hàng',
        6 => 'May'
    );
    private $error = '';

    public function __construct(){
        parent::__construct();
        Loader::loadJS('backend/js/admin.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/datetimepicker/datetimepicker.css', CGlobal::$postHead);
        Loader::loadJS('libs/datetimepicker/jquery.datetimepicker.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/upload/cssUpload.css', CGlobal::$postHead);
        Loader::loadJS('libs/upload/jquery.uploadfile.js', CGlobal::$postEnd);
        Loader::loadJS('backend/js/upload-admin.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/jAlert/jquery.alerts.css', CGlobal::$postHead);
        Loader::loadJS('libs/jAlert/jquery.alerts.js', CGlobal::$postEnd);
    }

    public function listView(){
        $pageNo = (int)Request::get('page', 1);
        $pageScroll = CGlobal::num_scroll_page;
        $limit = CGlobal::num_record_per_page;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = array();
        $total = 0;

        $search['ten_sv'] = addslashes(Request::get('ten_sv', ''));
        $search['msv'] = addslashes(Request::get('msv', ''));
        $search['sv_status'] = (int)Request::get('sv_status', -1);
        $search['sv_focus'] = (int)Request::get('sv_focus', -1);
        $search['submit'] = (int)Request::get('submit', 0);
        $search['field_get'] = '';

        $dataSearch = Sinhvien::searchByCondition($search, $limit, $offset, $total);
        $paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';

        $optionStatus = Utility::getOption($this->arrStatus, $search['sv_status']);
        $optionFocus = Utility::getOption($this->arrFocus, $search['sv_focus']);
        $messages = Utility::messages('messages');

        return view('Admin::sinhvien.list', [
            'data' => $dataSearch,
            'total' => $total,
            'paging' => $paging,
            'arrStatus' => $this->arrStatus,
            'optionStatus' => $optionStatus,
            'arrFocus' => $this->arrFocus,
            'optionFocus' => $optionFocus,
            'search' => $search,
            'messages' => $messages,
        ]);

    }


    public function getItem($id=0){

        Loader::loadJS('libs/ckeditor/ckeditor.js', CGlobal::$postHead);

        $data = array();

        if($id > 0) {
            $data = Sinhvien::getById($id);
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['sv_status'])? $data['sv_status'] : -1);
        $optionFocus = Utility::getOption($this->arrFocus, isset($data['sv_focus'])? $data['sv_focus'] : CGlobal::status_hide);
        $optionSchool = Utility::getOption($this->school, isset($data['truong_hoc']) ? $data['truong_hoc'] : -1);
        $optionGender = Utility::getOption($this->arrGender, isset($data['gioi_tinh']) ? $data['gioi_tinh'] : -1);
        $optionTrainSystem = Utility::getOption($this->arrTrainSystem, isset($data['he_dao_tao']) ? $data['he_dao_tao'] : -1);
        $optionCareer = Utility::getOption($this->arrCareer, isset($data['nganh']) ? $data['nganh'] : -1);

        return view('Admin::sinhvien.add',[
            'id'=>$id,
            'data'=>$data,
            'optionStatus'=>$optionStatus,
            'optionFocus'=>$optionFocus,
            'optionSchool' => $optionSchool,
            'optionGender' => $optionGender,
            'optionTrainSystem' => $optionTrainSystem,
            'optionCareer' => $optionCareer,
            'error'=>$this->error,
        ]);

    }
    public function postItem($id=0){

        Loader::loadJS('libs/ckeditor/ckeditor.js', CGlobal::$postHead);

        $id_hiden = (int)Request::get('id_hiden', 0);
        $data = array();

        $dataSave = array(
            'ten_sv'=>array('value'=>addslashes(Request::get('ten_sv')), 'require'=>1, 'messages'=>'Tên không được trống!'),
            'password' =>array('value' => addslashes(Request::get('password')), 'require' => 0, 'messages' => 'Mật khẩu không được trống!'),
            'sv_re_password' => array('value' => addslashes(Request::get('sv_re_password')), 'require' => 0, 'messages' => 'Nhập lại mật khẩu không được trống!'),
            'truong_hoc'=>array('value'=>(int)Request::get('truong_hoc'),'require'=>0),
            'msv'=>array('value'=>addslashes(Request::get('msv')),'require'=>0 , 'messages' => 'Mã sinh viên không được trống!'),
            'ngaysinh'=>array('value'=>trim(Request::get('ngaysinh')),'require'=>0),
            'gioi_tinh' => array('value' => (int)(Request::get('gioi_tinh')), 'require' => 0),
            'he_dao_tao' => array('value' => (int)(Request::get('he_dao_tao')), 'require' => 0),
            'so_cmt' => array('value' => (int)Request::get('so_cmt'), 'require' => 0, 'messages' => 'Số chứng minh thư không được trống!'),
            'sv_description' => array('value' => addslashes(Request::get('sv_description')), 'require' => 0),
            'noi_o' => array('value' => addslashes(Request::get('noi_o')), 'require' => 0),
            'email_truong' => array('value' => addslashes(Request::get('email_truong')), 'require' => 0, 'messages' => 'Email trường không được trống'),
            'email_ca_nhan' => array('value' => addslashes(Request::get('email_ca_nhan')), 'require' => 0, 'messages' => 'Email cá nhân không được trống'),
            'dien_thoai' => array('value' => addslashes(Request::get('dien_thoai')), 'require' => 0, 'messages' => 'Số điện thoại không được trống'),
            'lop' => array('value' => addslashes(Request::get('lop')), 'require' => 0),
            'khoa' =>array('value' => addslashes(Request::get('khoa')), 'require' => 0) ,
            'nganh' => array('value' => addslashes(Request::get('nganh')), 'require' => 0),
            'quoc_gia' => array('value' => addslashes(Request::get('quoc_gia')), 'require' => 0, 'Quốc gia không được trống'),
            'quan_huyen' => array('value' => addslashes(Request::get('quan_huyen')), 'require' => 0, 'Quận huyện không được trống'),
            'xa_phuong' => array('value' => addslashes(Request::get('xa_phuong')), 'require' => 0),
            'sv_order_no'=>array('value'=>(int)addslashes(Request::get('sv_order_no')),'require'=>0),
            'sv_created'=>array('value'=>time()),
            'sv_status'=>array('value'=>(int)Request::get('sv_status', -1),'require'=>0),
            'sv_focus'=>array('value'=>(int)Request::get('sv_focus', -1),'require'=>0),
        );

//        //Add thời gian cho ngành sinh
//        $dateOfBirth = $dataSave['ngaysinh']['value'];
//        $dateOfBirth = ($dateOfBirth != '') ? strtotime($dateOfBirth . '00:00:00') : 0;
//        $dataSave['ngaysinh']['value'] = $dateOfBirth;
//        //end add time

        if($id > 0){
            unset($dataSave['sv_created']);
        }

        $this->error = ValidForm::validInputData($dataSave);
        if($this->error == ''){
            $id = ($id == 0) ? $id_hiden : $id;
            Sinhvien::saveData($id, $dataSave);
            return Redirect::route('admin.sinh_vien');
        }else{
            foreach($dataSave as $key=>$val){
                $data[$key] = $val['value'];
            }
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['sv_status'])? $data['sv_status'] : -1);
        $optionFocus = Utility::getOption($this->arrFocus, isset($data['sv_focus'])? $data['sv_focus'] : CGlobal::status_hide);
        $optionSchool = Utility::getOption($this->school, isset($data['truong_hoc']) ? $data['truong_hoc'] : -1);
        $optionGender = Utility::getOption($this->arrGender, isset($data['gioi_tinh']) ? $data['gioi_tinh'] : -1);
        $optionTrainSystem = Utility::getOption($this->arrTrainSystem, isset($data['he_dao_tao']) ? $data['he_dao_tao'] : -1);
        $optionCareer = Utility::getOption($this->arrCareer, isset($data['nganh']) ? $data['nganh'] : -1);

        return view('Admin::sinhvien.add',[
            'id'=>$id,
            'data'=>$data,
            'optionStatus'=>$optionStatus,
            'optionFocus'=>$optionFocus,
            'optionSchool' => $optionSchool,
            'optionGender' => $optionGender,
            'optionTrainSystem' => $optionTrainSystem,
            'optionCareer' => $optionCareer,
            'error'=>$this->error,
        ]);
    }

    public function delete(){

        $listId = Request::get('checkItem', array());
        $token = Request::get('_token', '');
        if(Session::token() === $token){
            if(!empty($listId) && is_array($listId)){
                foreach($listId as $id){
                    Trash::addItem($id, 'Sinhvien', CGlobal::FOLDER_SINH_VIEN, 'sinh_vien_id', 'ten_sv', '', '');
                    Sinhvien::deleteId($id);
                }
                Utility::messages('messages', 'Xóa thành công!', 'success');
            }
        }
        return Redirect::route('admin.sinh_vien');
    }
}

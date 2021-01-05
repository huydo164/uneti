<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 06/2016
* @Version   : 1.0
*/
namespace App\Modules\Admin\Controllers;

use App\Modules\Models\Trash;
use App\Modules\Models\Type;
use App\Library\PHPDev\FuncLib;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Modules\Models\Category;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;

class CategoryController extends BaseAdminController{

    private $arrStatus = array(-1 => '--Chọn--', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $arrMenu = array(-1 => '--Chọn--', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $arrFooter = array(-1 => '--Chọn--', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
    private $arrHot = array(-1 => '--Chọn--', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');

    private $arrType = array(-1=>'--Chọn--');
    private $strCategoryProduct = '';

    private $error = '';
    public function __construct(){
        parent::__construct();
        Loader::loadJS('backend/js/admin.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/upload/cssUpload.css', CGlobal::$postHead);
        Loader::loadJS('libs/upload/jquery.uploadfile.js', CGlobal::$postEnd);
        Loader::loadJS('backend/js/upload-admin.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/jAlert/jquery.alerts.css', CGlobal::$postHead);
        Loader::loadJS('libs/jAlert/jquery.alerts.js', CGlobal::$postEnd);

        $this->arrType = TypeController::getArrType();

    }
    public function listView(){

        //Config Page
        $pageNo = (int) Request::get('page', 1);
        $pageScroll = CGlobal::num_scroll_page;
        $limit = 1000;//CGlobal::num_record_per_page;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = array();
        $total = 0;

        $search['category_title'] = addslashes(Request::get('category_title', ''));
        $search['category_status'] = (int)Request::get('category_status', -1);
        $search['category_menu'] = (int)Request::get('category_menu', -1);
        $search['category_menu_footer'] = (int)Request::get('category_menu_footer', -1);
        $search['category_type_id'] = (int)Request::get('category_type_id', -1);
        $search['category_hot'] = (int)Request::get('category_hot', -1);
        $search['submit'] = (int)Request::get('submit', 0);
        $search['field_get'] = '';
        $dataSearch = Category::searchByCondition($search, $limit, $offset, $total);
        $paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';

        if(!empty($dataSearch)){
            foreach($dataSearch as $k => $v){
                $data[] = array(
                    'category_id'=>$v->category_id,
                    'category_title'=>$v->category_title,
                    'category_type_id'=>$v->category_type_id,
                    'category_type_keyword'=>$v->category_type_keyword,
                    'category_parent_id'=>$v->category_parent_id,
                    'category_menu'=>$v->category_menu,
                    'category_menu_footer'=>$v->category_menu_footer,
                    'category_hot'=>$v->category_hot,
                    'category_created'=>$v->category_created,
                    'category_order_no'=>$v->category_order_no,
                    'category_status'=>$v->category_status,

                );
            }
        }
        
        //Sort Data
        $newData = array();
        Category::sortListView($data, 0, $newData);
        $data = $newData;

        $optionStatus = Utility::getOption($this->arrStatus, $search['category_status']);
        $optionMenu = Utility::getOption($this->arrMenu, $search['category_menu']);
        $optionFooter = Utility::getOption($this->arrFooter, $search['category_menu_footer']);
        $optionType = Utility::getOption($this->arrType, $search['category_type_id']);
        $optionHot = Utility::getOption($this->arrHot, $search['category_hot']);

        $messages = Utility::messages('messages');
        return view('Admin::category.list',[
            'data'=>$data,
            'total'=>$total,
            'paging'=>$paging,
            'arrStatus'=>$this->arrStatus,
            'optionStatus'=>$optionStatus,
            'arrMenu'=>$this->arrMenu,
            'optionMenu'=>$optionMenu,
            'arrFooter'=> $this->arrFooter,
            'optionFooter'=> $optionFooter,
            'arrType'=> $this->arrType,
            'optionType'=> $optionType,
            'arrHot'=> $this->arrHot,
            'optionHot'=> $optionHot,
            'search'=>$search,
            'messages'=>$messages,
        ]);
    }
    public function getItem($id=0){

        $data = array();
        if($id > 0) {
            $data = Category::getById($id);
        }
        $optionStatus = Utility::getOption($this->arrStatus, isset($data['category_status'])? $data['category_status'] : CGlobal::status_show);
        $optionMenu = Utility::getOption($this->arrMenu, isset($data['category_menu'])? $data['category_menu'] : -1);
        $optionFooter = Utility::getOption($this->arrFooter, isset($data['category_menu_footer'])? $data['category_menu_footer'] : -1);
        $optionType = Utility::getOption($this->arrType, isset($data['category_type_id'])? $data['category_type_id'] : -1);
        $optionHot = Utility::getOption($this->arrHot, isset($data['category_hot'])? $data['category_hot'] : -1);
        $this->strCategoryProduct = CategoryController::createOptionCategory(0, isset($data['category_parent_id'])? $data['category_parent_id'] : -1);

        return view('Admin::category.add',[
            'id'=>$id,
            'data'=>$data,
            'optionStatus'=>$optionStatus,
            'optionMenu'=>$optionMenu,
            'optionFooter'=>$optionFooter,
            'optionType'=>$optionType,
            'optionHot'=>$optionHot,
            'strCategoryProduct'=>$this->strCategoryProduct,
            'error'=>$this->error,
        ]);
    }
    public function postItem($id=0){

        $id_hiden = (int)Request::get('id_hiden', 0);
        $data = array();

        $dataSave = array(
            'category_title'=>array('value'=>addslashes(Request::get('category_title')), 'require'=>1, 'messages'=>'Tiêu đề không được trống!'),
            'category_title_alias'=>array('value'=>FuncLib::safeTitle(Request::get('category_title')), 'require'=>0),
            'category_intro'=>array('value'=>addslashes(Request::get('category_intro')),'require'=>0),
            'category_order_no'=>array('value'=>(int)addslashes(Request::get('category_order_no')),'require'=>0),
            'category_parent_id'=>array('value'=>(int)addslashes(Request::get('category_parent_id')),'require'=>0),
            'category_type_id'=>array('value'=>(int)addslashes(Request::get('category_type_id')),'require'=>0),
            'category_menu'=>array('value'=>(int)Request::get('category_menu', -1),'require'=>0),
            'category_menu_footer'=>array('value'=>(int)(Request::get('category_menu_footer')),'require'=>0),
            'category_hot'=>array('value'=>(int)(Request::get('category_hot', -1)),'require'=>0),
            'category_status'=>array('value'=>(int)(Request::get('category_status')),'require'=>0),
            'category_created'=>array('value'=>time(),'require'=>0),
            'category_link_replace'=>array('value'=>addslashes(Request::get('category_link_replace')),'require'=>0),

            'meta_title'=>array('value'=>addslashes(Request::get('meta_title ')),'require'=>0),
            'meta_keywords'=>array('value'=>addslashes(Request::get('meta_keywords')),'require'=>0),
            'meta_description'=>array('value'=>addslashes(Request::get('meta_description')),'require'=>0),
        );

        if($id > 0){
            unset($dataSave['category_created']);
        }

        if($dataSave['category_type_id']['value'] > 0){
            $arrType = Type::getById($dataSave['category_type_id']['value']);
            if($arrType != null){
                $dataSave['category_type_keyword']['value'] = $arrType->type_keyword;
            }else{
                $dataSave['category_type_keyword']['value'] = 0;
            }
        }

        $this->error = ValidForm::validInputData($dataSave);
        if($this->error == ''){
            $id = ($id == 0) ? $id_hiden : $id;
            //So Sanh Anh Cu Va Moi, Neu Khac Nhau thi Xoa Anh Cu Di
            if($id > 0){
                $category_image = trim(addslashes(Request::get('img')));
                $category_image_old = trim(addslashes(Request::get('img_old')));
                if($category_image_old !== '' && $category_image !== '' && strcmp ( $category_image_old , $category_image ) != 0){
                    $path = Config::get('config.DIR_ROOT').'uploads/'.CGlobal::FOLDER_CATEGORY.'/'.$id;
                    if(is_file($path.'/'.$category_image_old)){
                        @unlink($path.'/'.$category_image_old);
                    }
                }
            }
            Category::saveData($id, $dataSave);
            return Redirect::route('admin.category');
        }else{
            foreach($dataSave as $key=>$val){
                $data[$key] = $val['value'];
            }
        }

        $optionStatus = Utility::getOption($this->arrStatus, isset($data['category_status'])? $data['category_status'] : CGlobal::status_show);
        $optionMenu = Utility::getOption($this->arrMenu, isset($data['category_menu'])? $data['category_menu'] : -1);
        $optionFooter = Utility::getOption($this->arrFooter, isset($data['category_menu_footer'])? $data['category_menu_footer'] : -1);
        $optionType = Utility::getOption($this->arrType, isset($data['category_type_id'])? $data['category_type_id'] : -1);
        $optionHot = Utility::getOption($this->arrHot, isset($data['category_hot'])? $data['category_hot'] : -1);
        $this->strCategoryProduct = CategoryController::createOptionCategory(0, isset($data['category_parent_id'])? $data['category_parent_id'] : -1);

        return view('Admin::category.add',[
            'id'=>$id,
            'data'=>$data,
            'optionStatus'=>$optionStatus,
            'optionMenu'=>$optionMenu,
            'optionFooter'=>$optionFooter,
            'optionType'=>$optionType,
            'optionHot'=>$optionHot,
            'strCategoryProduct'=>$this->strCategoryProduct,
            'error'=>$this->error,
        ]);
    }
    public function delete(){

        $listId = Request::get('checkItem', array());
        $token = Request::get('_token', '');
        if(Session::token() === $token){
            if(!empty($listId) && is_array($listId)){
                foreach($listId as $id){
                    Trash::addItem($id, 'Category', CGlobal::FOLDER_CATEGORY, 'category_id', 'category_title', 'category_image', '');
                    Category::deleteId($id);
                }
                Utility::messages('messages', 'Xóa thành công!', 'success');
            }
        }
        return Redirect::route('admin.category');
    }

    //List Option Category From Typeid
    public static function createOptionCategory($typeid=0, $value=0){
        $option = '<option value="0">--Chọn danh mục cha--</option>';
        $arrData = array();

        $dataCate['field_get'] = '';
        $arrCategory = Category::getAllCategory($typeid, $dataCate, 0);

        if($arrCategory != null){
            foreach($arrCategory as $k => $v){
                $arrData[] = array(
                    'category_id'=>$v->category_id,
                    'category_title'=>$v->category_title,
                    'category_type_id'=>$v->category_type_id,
                    'category_parent_id'=>$v->category_parent_id,
                );
            }
        }

        $newData = array();
        Category::sortListView($arrData, 0, $newData);

        if(!empty($newData)){
            foreach($newData as $item){
                if(isset($item['parent']) && !empty($item['parent'])){
                    if($value == $item['parent']['category_id']){
                        $selected = 'selected="selected"';
                    }else{
                        $selected = '';
                    }
                    $option .= '<option value="'.$item['parent']['category_id'].'" '.$selected.'>'.$item['parent']['category_title'].'</option>';
                }
                if(isset($item['sub']) && !empty($item['sub'])){
                    foreach($item['sub'] as $sub){
                        if($value == $sub['category_id']){
                            $selected = 'selected="selected"';
                        }else{
                            $selected = '';
                        }
                        $option .= '<option value="'.$sub['category_id'].'" '.$selected.'>----'.$sub['category_title'].'</option>';
                    }

                }
            }
        }
        return $option;
    }
    public static function getArrCategory($typeid=0){
        $result = array(-1=>'Danh mục cha');
        $dataSearch['field_get'] = '';
        $arrCate = Category::getAllCategory($typeid, $dataSearch, 0);
        if(!empty($arrCate)){
            foreach($arrCate as $cate){
                $result[$cate->category_id] =  $cate->category_title;
            }
        }
        return $result;
    }
}
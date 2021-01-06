<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 06/2016
* @Version   : 1.0
*/
namespace App\Modules\Statics\Controllers;

use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Memcache;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\SEOMeta;
use App\Library\PHPDev\ThumbImg;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;
use App\Modules\Models\Category;
use App\Modules\Models\Contact;
use App\Modules\Models\Info;
use App\Modules\Models\Orders;
use App\Modules\Models\Product;
use App\Modules\Models\Rating;
use App\Modules\Models\Statics;
use App\Modules\Models\Tag;
use App\Modules\Models\TagStatics;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class StaticsController extends BaseStaticsController{

    public function index(){
        Loader::loadJS('libs/owl.carousel/owl.carousel.min.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/owl.carousel/owl.carousel.min.css', CGlobal::$postHead);

        $meta_title = $meta_keywords = $meta_description = $meta_img = '';
        $arrMeta = Info::getItemByKeyword('SITE_SEO_HOME');
        if(!empty($arrMeta)){
            $meta_title = $arrMeta->meta_title;
            $meta_keywords = $arrMeta->meta_keywords;
            $meta_description = $arrMeta->meta_description;
            $meta_img = $arrMeta->info_img;
            if($meta_img != ''){
                $meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrMeta->info_id, $arrMeta->info_img, 550, 0, '', true, true);
            }
        }
        SEOMeta::init($meta_img, $meta_title, $meta_keywords, $meta_description);

        $cat_1 = (int)strip_tags(self::viewShareVal('CAT_ID_DVGV'));
        $data_cat_1 = [];
        if ($cat_1  > 0){
            $data_search_cat1['statics_catid'] = $cat_1;
            $data_search_cat1['statics_order_no'] = 'asc';
            $data_cat_1 = Statics::getFocus($data_search_cat1, 10);
        }
        $cat_2 = (int)strip_tags(self::viewShareVal('CAT_ID_DVSV'));
        $data_cat_2 = [];
        if ($cat_2 > 0){
            $data_search_2['statics_catid'] = $cat_2;
            $data_search_2['statics_order_no'] = 'asc';
            $data_cat_2 = Statics::getFocus($data_search_2, 10);
        }
        $cat_3 = (int)strip_tags(self::viewShareVal('CAT_ID_3'));
        $data_cat_3 = [];
        if ($cat_3 > 0){
            $data_search_3['statics_catid'] = $cat_3;
            $data_search_3['statics_order_no'] = 'asc';
            $data_cat_3 = Statics::getFocus($data_search_3, 10);
        }

        $title_dvgv = Info::getItemByKeyword('CAT_ID_DVGV');
        $title_dvsv = Info::getItemByKeyword('CAT_ID_DVSV');
        $title_hdsv = Info::getItemByKeyword('CAT_ID_3');
        $lien_he = Info::getItemByKeyword('TEXT_LIEN_HE');
        $messages = Utility::messages('messages');

        return view('Statics::content.index',[
            'messages' => $messages,
            'data_cat_1' => $data_cat_1,
            'data_cat_2' => $data_cat_2,
            'data_cat_3' => $data_cat_3,
            'title_dvgv' => $title_dvgv,
            'title_dvsv' => $title_dvsv,
            'title_hdsv' => $title_hdsv,
            'lien_he' => $lien_he,
        ]);
    }

    public function pageContactPost(){
        if (!empty($_POST)){
            $contact_email = addslashes(Request::get('email', ''));
            $contact_title = addslashes(Request::get('title', ''));
            $contact_content = addslashes(Request::get('content', ''));
            $contact_created = time();

            $checkEmail = ValidForm::checkRegexEmail($contact_email);

            if ($contact_email != '' && $contact_title != '' && $contact_content != ''){
                $dataInput = array(
                    'contact_email' => $contact_email,
                    'contact_title' => $contact_title,
                    'contact_content' => $contact_content,
                    'contact_created' => $contact_created,
                    'contact_status' => 0,
                );
                $query = Contact::addData($dataInput);
                if ($query > 0){
                    Utility::messages('messages', 'Bạn gửi phản hồi thành công');
                    return Redirect::route('SIndex');
                }
            }
            else{
                Utility::messages('messages', 'Thông tin chưa đúng mời bạn nhập lại');
                return Redirect::route('SIndex');
            }
        }
    }
}


<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 06/2016
* @Version   : 1.0
*/
namespace App\Modules\Statics\Controllers;

use App\Modules\Models\Banner;
use App\Modules\Models\Category;
use App\Modules\Models\Info;
use App\Modules\Models\User;

use App\Modules\Models\Statics;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\SEOMeta;
use App\Library\PHPDev\ThumbImg;
use Illuminate\Support\Facades\View;

class BaseStaticsController extends Controller{

    public function __construct(){

        $arrOnline = Info::getItemByKeyword('SITE_ONLINE');
        if(isset($arrOnline->info_status) && $arrOnline->info_status == CGlobal::status_show){
            $this->middleware(function ($request, $next) {
                $users = User::userLogin();
                if(empty($users)){
                    header('Content-Type: text/html; charset=utf-8');
                    echo '<div style="text-align: center"><img src="'.FuncLib::getBaseUrl().'assets/frontend/img/maintain.png"></div>';
                    echo '<div style="text-align: center; margin-top:10px">'.CGlobal::txtMaintain.'</div>';die;
                }
                return $next($request);
            });
        }

        Loader::loadJS('frontend/js/site.js', CGlobal::$postEnd);
        Loader::loadJS('libs/jAlert/jquery.alerts.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/jAlert/jquery.alerts.css', CGlobal::$postHead);
        Loader::loadCSS('libs/fontAwesome/css/font-awesome.min.css', CGlobal::$postHead);

        $bannerContent['banner_status'] = CGlobal::status_show;
        $bannerContent['banner_type'] = 1;
        $bannerContent['field_get'] = 'banner_id,banner_title,banner_title_show,banner_image,banner_link,banner_is_target,banner_is_rel,banner_is_run_time,banner_start_time,banner_end_time';
        $dataBannerContent = Banner::getBannerSite($bannerContent, $limit = 1, 'content');
        $dataBannerContent = FuncLib::checkBannerShow($dataBannerContent);
        View::share('dataBannerContent', $dataBannerContent);

        $arrCategory = Category::getAllCategory(0, array(), 0);
        View::share('arrCategory',$arrCategory);

        $logo = Info::getItemByKeyword('LOGO_UNETI');
        View::share('logo', $logo);

        $footer_left = Info::getItemByKeyword('SITE_FOOTER_LEFT');
        View::share('footer_left', $footer_left);
        $footer_address = Info::getItemByKeyword('SITE_FOOTER_ADDRESS');
        View::share('footer_address', $footer_address);
    }
    public function page403(){
        $meta_img='';
        $meta_title = $meta_keywords = $meta_description = $txt403 = CGlobal::txt403;
        SEOMeta::init($meta_img, $meta_title, $meta_keywords, $meta_description);
        return view('Statics::errors.page-403',['txt403'=>$txt403]);
    }
    public function page404(){
        $meta_img='';
        $meta_title = $meta_keywords = $meta_description = $txt404 = CGlobal::txt404;
        SEOMeta::init($meta_img, $meta_title, $meta_keywords, $meta_description);
        return view('Statics::errors.page-404',['txt404'=>$txt404]);
    }
    public static function viewShareVal($key=''){
        $str='';
        if($key != '') {
            $arrStr = Info::getItemByKeyword($key);
            if(isset($arrStr->info_id)) {
                $str = stripslashes($arrStr->info_content);
            }
        }
       return $str;
    }
}
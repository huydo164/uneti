<?php
namespace App\Modules\Sinhvien\Controllers;

use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Utility;
use App\Modules\Models\Info;
use App\Modules\Models\Sinhvien;
use App\Modules\Models\Statics;

class IndexSinhVienController extends BaseSinhVienController{

    public function  index(){
        $result = Sinhvien::memberLogin();
        if (isset($result['sinh_vien_id']) && $result['sinh_vien_id'] > 0){
            $data = Sinhvien::getById($result['sinh_vien_id']);
        }
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

        return view('Sinhvien::content.index', [
            'data' => $data,
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
}
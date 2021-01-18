<?php
namespace App\Modules\Sinhvien\Controllers;

use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Utility;
use App\Modules\Models\Form;
use App\Modules\Models\Info;
use App\Modules\Models\Sinhvien;
use App\Modules\Models\Statics;

class IndexSinhVienController extends BaseSinhVienController{

    public function  index(){
        $cat1 = (int)strip_tags(self::viewShareVal('CAT_ID_NEWS_STUDENT'));
        $data_cat_1 = [];
        if ($cat1 > 0){
            $data_search_cat1['statics_catid'] = $cat1;
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

        return view('Sinhvien::content.index',[
            'data_cat_1' => $data_cat_1,
            'data_cat_2' => $data_cat_2
        ]);
    }

    public function form(){
        $data = Form::getAllForm();
        $title_form = Info::getItemByKeyword('TEXT_FORM');
        return view('Sinhvien::content.form',[
            'data' => $data,
            'title_form' => $title_form,
        ]);
    }

    public function pageDetail($id){
        if ($id > 0){
            $data = Statics::getById($id);

            $searchSame['field_get'] = 'statics_id,statics_catid,statics_cat_name,statics_cat_alias,statics_title,statics_intro,statics_content,statics_image,statics_created';
            $dataSame = Statics::getSameData($id, $data->statics_catid,$limit=10, $searchSame);

            return view('Sinhvien::content.pageDetail',[
                'data' => $data,
                'dataSame' => $dataSame,
            ]);
        }
    }
}
<?php

namespace App\Modules\Models;

use App\Library\PHPDev\CDatabase;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Memcache;
use App\Library\PHPDev\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use PDOException;

class Form extends Model{
    protected $table = CDatabase::form;
    protected $primaryKey = 'form_id';
    public $timestamps = false;

    protected $fillable = [
        'form_id', 'form_title', 'form_upload', 'form_status', 'form_order_no', 'form_created'
    ];

    public static function searchByCondition($dataSearch = array(), $limit = 0, $offset = 0, &$total){
        try {
            $query = Form::where('form_id', '>', 0);

            if (isset($dataSearch['form_title']) && $dataSearch['form_title'] != ''){
                $query->where('form_title', 'LIKE', '%'.$dataSearch['form_title'].'%');
            }
            if (isset($dataSearch['form_status']) && $dataSearch['form_status'] != -1){
                $query->where('form_status', $dataSearch['form_status']);
            }

            $total = $query->count(['form_id']);
            $query->orderBy('form_id', 'asc');

            $fields = (isset($dataSearch['field_get']) && trim($dataSearch['field_get']) != '') ? explode(',', trim($dataSearch['field_get'])) : array();
            if (!empty($fields)){
                $result = $query->take($limit)->skip($offset)->get($fields);
            }
            else{
                $result = $query->take($limit)->skip($offset)->get();
            }

            return $result;

        }catch (PDOException $e){
            throw new PDOException();
        }
    }
    public static function getById($id = 0){
        $result = (Memcache::CACHE_ON) ? Cache::get(Memcache::CACHE_FORM_ID.$id) : array();

        try {
            if (empty($result)){
                $result = Form::where('form_id', $id)->first();
                if ($result && Memcache::CACHE_ON){
                    Cache::put(Memcache::CACHE_FORM_ID.$id, $result, Memcache::CACHE_TIME_TO_LIVE_ONE_MONTH);
                }
            }
        }catch (PDOException $e){
            throw new PDOException();
        }
        return $result;
    }

    public static function updateData($id = 0, $dataInput = array()){
        try {
            DB::connection()->getPdo()->beginTransaction();

            $data = Form::getById($id);
            if ($id > 0 && !empty($dataInput)){
                $data->update($dataInput);
                if (isset($data->form_id) && $data->form_id > 0){
                    self::removeCacheId($data->form_id);
                }
            }
            DB::connection()->getPdo()->commit();
            return true;

        }catch (PDOException $e){
            DB::connection()->getPdo()->rollback();
            throw new PDOException();
        }
    }

    public static function addData($dataInput = array()){
        try {
            DB::connection()->getPdo()->beginTransaction();
            $data = new Form();
            if (is_array($dataInput) && count($dataInput) > 0) {
                foreach ($dataInput as $k => $v) {
                    $data->$k = $v;
                }
            }
            if ($data->save()) {
                DB::connection()->getPdo()->commit();
                if($data->form_id && Memcache::CACHE_ON){
                    Form::removeCacheId($data->form_id);
                }
                return $data->form_id;
            }
            DB::connection()->getPdo()->commit();
            return false;
        } catch (PDOException $e) {
            DB::connection()->getPdo()->rollBack();
            throw new PDOException();
        }
    }

    public static function saveData($id = 0, $data = array()){
        $data_post = array();

        if (!empty($data)){
            foreach ($data as $key => $val){
                $data_post[$key] = $val['value'];
            }
        }

        if ($id > 0){
            Form::updateData($id, $data_post);
            Utility::messages('messages', 'Cập nhật thành công!');
        }
        else{
            Form::addData($data_post);
            Utility::messages('messages', 'Thêm mới thành công!');
        }
    }

    public static function deleteId($id = 0){
        try {
            DB::connection()->getPdo()->beginTransaction();

            $data = Form::find($id);
            if ($data != null){

                $form_upload = ($data->form_upload != '') ? $data->form_upload : array();
                if(is_array($form_upload) && !empty($form_upload)){
                    $path = Config::get('config.DIR_ROOT').'uploads/'.CGlobal::FOLDER_FORM.'/'.$id;
                    foreach($form_upload as $v){
                        if(is_file($path.'/'.$v)){
                            @unlink($path.'/'.$v);
                        }
                    }
                    if(is_dir($path)) {
                        @rmdir($path);
                    }
                }

                $data->delete();
                if (isset($data->form_id) && $data->form_id > 0){
                    self::removeCacheId($data->form_id);
                }
                DB::connection()->getPdo()->commit();
            }
            return true;

        }catch (PDOException $e){
            DB::connection()->getPdo()->rollback();
            throw new PDOException();
        }
    }

    public static function getAllForm(){
        $result = (Memcache::CACHE_ON) ? Cache::get(Memcache::CACHE_FORM_ID) : array();
        try {
            if (empty($result)){
                $result = Form::where('form_id', '>', 0)->get();
                if ($result && Memcache::CACHE_ON){
                    Cache::put(Memcache::CACHE_FORM_ID, $result, Memcache::CACHE_TIME_TO_LIVE_ONE_MONTH);
                }
            }

        }catch (PDOException $e){
            throw new PDOException();
        }
        return $result;
    }

    public static function removeCacheId($id = 0){
        if ($id > 0){
            Cache::forget(Memcache::CACHE_FORM_ID.$id);
        }
    }
}
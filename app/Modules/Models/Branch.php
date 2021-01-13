<?php

namespace App\Modules\Models;

use App\Library\PHPDev\CDatabase;
use App\Library\PHPDev\Memcache;
use App\Library\PHPDev\Utility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Branch extends Model{
    protected $table = CDatabase::branch;
    protected $primaryKey = 'branch_id';
    public $timestamps = false;

    protected $fillable = [
        'branch_id', 'branch_name', 'branch_created', 'branch_status', 'branch_id_project', 'branch_id_sv'
    ];

    public static function searchByCondition($dataSearch = array(), $limit = 0, $offset = 0, &$total){
        try {
            $query = Branch::where('branch_id', '>', 0);

            if (isset($dataSearch['branch_name']) && $dataSearch['branch_name'] != ''){
                $query->where('branch_name', 'LIKE', '%'.$dataSearch['branch_name'].'%');
            }
            if (isset($dataSearch['branch_status']) && $dataSearch['branch_status'] != -1){
                $query->where('branch_status', $dataSearch['branch_status']);
            }

            $total = $query->count(['branch_id']);
            $query->orderBy('branch_id', 'asc');

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
        $result = (Memcache::CACHE_ON) ? Cache::get(Memcache::CACHE_BRANCH_ID.$id) : array();

        try {
            if (empty($result)){
                $result = Branch::where('branch_id', $id)->first();
                if ($result && Memcache::CACHE_ON){
                    Cache::put(Memcache::CACHE_BRANCH_ID.$id, $result, Memcache::CACHE_TIME_TO_LIVE_ONE_MONTH);
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

            $data = Branch::getById($id);
            if ($id > 0 && !empty($dataInput)){
                $data->update($dataInput);
                if (isset($data->branch_id) && $data->branch_id > 0){
                    self::removeCacheId($data->branch_id);
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
            $data = new Branch();
            if (is_array($dataInput) && count($dataInput) > 0) {
                foreach ($dataInput as $k => $v) {
                    $data->$k = $v;
                }
            }
            if ($data->save()) {
                DB::connection()->getPdo()->commit();
                if($data->branch_id && Memcache::CACHE_ON){
                    Branch::removeCacheId($data->branch_id);
                }
                return $data->branch_id;
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
            Branch::updateData($id, $data_post);
            Utility::messages('messages', 'Cập nhật thành công!');
        }
        else{
            Branch::addData($data_post);
            Utility::messages('messages', 'Thêm mới thành công!');
        }
    }

    public static function deleteId($id = 0){
        try {
            DB::connection()->getPdo()->beginTransaction();

            $data = Branch::find($id);
            if ($data != null){
                $data->delete();
                if (isset($data->branch_id) && $data->branch_id > 0){
                    self::removeCacheId($data->branch_id);
                }
                DB::connection()->getPdo()->commit();
            }
            return true;

        }catch (PDOException $e){
            DB::connection()->getPdo()->rollback();
            throw new PDOException();
        }
    }

    public static function removeCacheId($id = 0){
        if ($id > 0){
            Cache::forget(Memcache::CACHE_BRANCH_ID.$id);
        }
    }
}
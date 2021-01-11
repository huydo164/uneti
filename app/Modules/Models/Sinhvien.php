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
use Illuminate\Support\Facades\Session;
use PDOException;

class Sinhvien extends Model{
    protected $table = CDatabase::sinh_vien;
    protected $primaryKey = 'sinh_vien_id';
    public $timestamps = false;

    protected $fillable = [
        'sinh_vien_id', 'ten_sv', 'password', 'truong_hoc', 'msv', 'ngaysinh', 'gioi_tinh', 'he_dao_tao', 'sv_status', 'so_cmt', 'sv_description',
        'noi_o', 'email_truong', 'email_ca_nhan', 'dien_thoai', 'lop', 'khoa', 'nganh', 'quoc_gia', 'quan_huyen', 'xa_phuong', 'sv_focus', 'sv_order_no', 'sv_created', 'sv_re_password'
    ];

    public static function getMemberByEmail($name){
        $result = Sinhvien::where('ten_sv', $name)->first();
        return $result;
    }
    public static function encode_password($password){
        return md5(md5($password));
    }
    public static function updateLogin($user = array()){
        if($user){

        }
        return true;
    }
    public static function memberLogin(){
        $user = array();
        if(Session::has('member')){
            $user = Session::get('member');
        }
        return $user;
    }
    public static function isLogin(){
        $result = 0;
        if(Session::has('member')){
            $result = 1;
        }
        return $result;
    }
    public static function searchByCondition($dataSearch = array(), $limit = 0, $offset = 0, &$total ){
        try {
            $query = Sinhvien::where('sinh_vien_id' , '>', 0);

            if (isset($dataSearch['ten_sv']) && $dataSearch['ten_sv'] != ''){
                $query->where(['ten_sv'], 'LIKE', '%' . $dataSearch['ten_sv']. '%');
            }
            if (isset($dataSearch['msv']) && $dataSearch['msv'] != ''){
                $query->where(['msv'], 'LIKE', '%'.$dataSearch['msv'] . '%');
            }
            if (isset($dataSearch['sv_status']) && $dataSearch['sv_status'] != -1){
                $query->where(['sv_status', $dataSearch['sv_status']]);
            }

            $total = $query->count();
            $query->orderBy('sinh_vien_id', 'asc');
            $fields = (isset($dataSearch['field_get']) && trim($dataSearch['field_get']) != '') ? explode(',', trim($dataSearch['field_get'])) : array();
            if (!empty($fields)){
                $result = $query->take($limit)->skip($offset)->offset($fields);
            }
            else{
                $result = $query->take($limit)->skip($offset)->get();
            }

            return $result;
        }
        catch (PDOException $e){
            throw new PDOException();
        }
    }
    public static function getById($id=0){

        $result = (Memcache::CACHE_ON) ? Cache::get(Memcache::CACHE_SINHVIEN_ID.$id) : array();
        try {
            if(empty($result)){
                $result = Sinhvien::where('sinh_vien_id', $id)->first();
                if($result && Memcache::CACHE_ON){
                    Cache::put(Memcache::CACHE_SINHVIEN_ID.$id, $result, Memcache::CACHE_TIME_TO_LIVE_ONE_MONTH);
                }
            }
        } catch (PDOException $e) {
            throw new PDOException();
        }

        return $result;
    }

    public static function updateData($id=0, $dataInput=array()){
        try {
            DB::connection()->getPdo()->beginTransaction();
            $data = Sinhvien::getById($id);
            //FuncLib::bug($data);
            if($id > 0 && !empty($dataInput)){
                $data->update($dataInput);
                if(isset($data->sinh_vien_id) && $data->sinh_vien_id > 0){
                    self::removeCacheId($data->sinh_vien_id);
                }
            }
            DB::connection()->getPdo()->commit();
            return $id;
        } catch (PDOException $e) {
            DB::connection()->getPdo()->rollBack();
            throw new PDOException();
        }
    }

    public static function addData($dataInput=array()){
        try {
            DB::connection()->getPdo()->beginTransaction();
            $data = new Sinhvien();
            if (is_array($dataInput) && count($dataInput) > 0) {
                foreach ($dataInput as $k => $v) {
                    $data->$k = $v;
                }
            }
            if ($data->save()) {
                DB::connection()->getPdo()->commit();
                if($data->sinh_vien_id && Memcache::CACHE_ON){
                    Sinhvien::removeCacheId($data->sinh_vien_id);
                }
                return $data->sinh_vien_id;
            }
            DB::connection()->getPdo()->commit();
            return false;
        } catch (PDOException $e) {
            DB::connection()->getPdo()->rollBack();
            throw new PDOException();
        }
    }

    public static function saveData($id=0, $data=array()){
        $data_post = array();
        if(!empty($data)){
            foreach($data as $key=>$val){
                $data_post[$key] = $val['value'];
            }
        }
        if($id > 0){
            Sinhvien::updateData($id, $data_post);
            Utility::messages('messages', 'Cập nhật thành công!');
        }else{
            Sinhvien::addData($data_post);
            Utility::messages('messages', 'Thêm mới thành công!');
        }
    }

    public static function deleteId($id=0){
        try {
            DB::connection()->getPdo()->beginTransaction();
            $data = Sinhvien::find($id);
            if($data != null){
                $data->delete();
                if(isset($data->sinh_vien_id) && $data->sinh_vien_id > 0){
                    self::removeCacheId($data->sinh_vien_id);
                }
                DB::connection()->getPdo()->commit();
            }
            return true;
        } catch (PDOException $e) {
            DB::connection()->getPdo()->rollBack();
            throw new PDOException();
        }
    }

    public static function removeCacheId($id=0){
        if($id>0){
            Cache::forget(Memcache::CACHE_SINHVIEN_ID.$id);
        }
    }

}
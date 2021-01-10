<?php
namespace App\Modules\Sinhvien\Controllers;

use App\Modules\Models\Sinhvien;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LoginSinhVienController extends Controller{
    public function __construct(){
        parent::__construct();
    }
    public function postLogin($url=''){

        if(Session::has('member')){
            die('');
        }

        $token = addslashes(Request::get('_token', ''));
        $mail = addslashes(Request::get('ten_sv', ''));
        $pass = addslashes(Request::get('password', ''));
        $error = '';

        if(Session::token() === $token){
            if($mail != '' && $pass != ''){
                $member = Sinhvien::getMemberByEmail($mail);
                if(isset($member->sinh_vien_id)){
                    if($member->sv_status == 0 || $member->sv_status == -1){
                        $error = 'Tài khoản đang bị khóa!';
                    }elseif($member->sv_status == 1){
                        $encode_password = Sinhvien::encode_password($pass);
                        if($member->password == $encode_password){
                            $data = array(
                                'sinh_vien_id' => $member->sinh_vien_id,
                                'ten_sv' => $member->ten_sv
                            );

                            Session::put('member', $data, 60*24);
                            Session::save();

                            Sinhvien::updateLogin($member);
                            return Redirect::route('indexSinhVien');

                        }else{
                            $error = 'Mật khẩu chưa đúng!';
                        }
                    }
                }else{
                    $error = 'Không tồn tại tên đăng nhập!';
                }
            }else{
                $error = 'Thông tin đăng nhập chưa đúng!';
            }
        }else{
            $error .= 'Phiên làm việc hết hạn. Bạn refresh lại trang web!';
        }
        echo $error;die;
    }
    public function logout(){
        if(Session::has('member')){
            Session::forget('member');
        }
        return Redirect::route('SIndex');
    }
}
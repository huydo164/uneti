<?php
namespace App\Modules\Sinhvien\Controllers;

use App\Library\PHPDev\FuncLib;
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
        $msv = addslashes(Request::get('msv', ''));
        $pass = addslashes(Request::get('password', ''));
        $error = '';

        if(Session::token() === $token){
            if($msv != '' && $pass != ''){
                $member = Sinhvien::getMemberByMSV($msv);
                if(isset($member->sinh_vien_id)){
                    if($member->sv_status == 0 || $member->sv_status == -1){
                        $error = 'Tài khoản đang bị khóa!';
                    }elseif($member->sv_status == 1){
                        $encode_password = Sinhvien::encode_password($pass);

                        if($member->password == $encode_password){
                            $data = array(
                                'sinh_vien_id' => $member->sinh_vien_id,
                                'msv' => $member->msv,
                                'ten_sv' => $member->ten_sv,
                                'sv_img' => $member->sv_img,
                            );

                            Session::put('member', $data, 60*24);
                            Session::save();

                            Sinhvien::updateLogin($member);
                            return Redirect::route('indexSinhVien');

                        }else{
                            $error = 'Mật khẩu chưa đúng!';
                            return Redirect::route('SIndex');
                        }
                    }
                }else{
                    $error = 'Không tồn tại tên đăng nhập!';
                    echo $error;
                    return Redirect::route('SIndex');
                }
            }else{
                $error = 'Thông tin đăng nhập chưa đúng!';
                return Redirect::route('SIndex');
            }
        }else{
            $error .= 'Phiên làm việc hết hạn. Bạn refresh lại trang web!';
            return Redirect::route('SIndex');
        }
    }
    public function logout(){
        if(Session::has('member')){
            Session::forget('member');
        }
        return Redirect::route('SIndex');
    }
}
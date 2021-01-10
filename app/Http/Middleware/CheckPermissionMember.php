<?php

namespace App\Http\Middleware;

use App\Modules\Models\Sinhvien;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CheckPermissionMember{

    public function handle($request, Closure $next){

        if(!Sinhvien::isLogin()) {
            return Redirect::route('SIndex', array('url' =>  FuncLib::buildUrlEncode(URL::current())));
        }else{
            $member = Sinhvien::memberLogin();
            if(isset($member['sinh_vien_id']) && $member['sinh_vien_id'] > 0){
                return $next($request);
            }
            return Redirect::route('SIndex');
        }
    }
}
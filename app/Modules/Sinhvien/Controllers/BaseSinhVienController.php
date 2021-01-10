<?php
namespace App\Modules\Sinhvien\Controllers;

use App\Modules\Models\Sinhvien;
use Illuminate\Support\Facades\View;

class BaseSinhVienController extends Controller{
    protected $member = array();

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->member = Sinhvien::memberLogin();
            View::share('member', $this->member);
            return $next($request);
        });
    }
}
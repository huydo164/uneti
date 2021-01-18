<?php
$namespace = '\App\Modules\Sinhvien\Controllers';

Route::group(['middleware' => ['web'], 'prefix' => '/', 'namespace' => $namespace], function(){
    Route::post('mLogin', array('as' => 'mPostLogin','uses' => 'LoginSinhVienController@postLogin'));
    Route::get('mLogout', array('as' => 'mLogout','uses' => 'LoginSinhVienController@logout'));
});

Route::group(['middleware' => ['web', 'checkPermissionMember'], 'prefix' => 'member', 'namespace' => $namespace , 'group'=>'1','group_name'=>'Trang thành viên', 'display_icon'=>'fa fa-desktop'], function () {
    Route::get('indexSinhVien', array('as' => 'indexSinhVien','uses' => 'IndexSinhVienController@index', 'permission_name'=>'Trang chủ'));

    //Biẻu mẫu
    Route::get('indexSinhVien/bieu-mau', array('as' => 'bieu_mau', 'uses' => 'IndexSinhVienController@form', 'permission_name' => 'Biểu mẫu'));

    //Page Detail
    Route::get('indexSinhVien/tin/{id}', array('as' => 'site.pageStaticsDetail', 'uses' => 'IndexSinhVienController@pageDetail', 'permission_name' => 'Chi tiết tin tức'));
});

<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
?>
@if(isset($member) && empty($member))
<div id="myModalLogin" class="modal fade" tabindex="-1" role="dialog" style="display:none">
    <div class="modal-dialog modal-dialog-popup" role="document">
        <div class="modal-content bgIndex">
            <div class="modal-title-classic">Đăng nhập</div>
            <div class="content-popup-body">
                <div class="contentLogin">
                    <form id="formlogin" method="POST" class="formLoginMember box-form-register" name="txtForm" action="{{route('mPostLogin')}}" >
                        <div class="form-group">
                            <label>Mã sinh viên:</label>
                            <input type="text" name="msv" class="form-control txtUser" placeholder="Tên đăng nhập" >
                        </div>
                        <div class="form-group ">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" class="form-control txtPass" placeholder="Mật khẩu" >
                        </div>
                        <div class="button">
                            <button type="submit" class="btn btn-primary submitUser">Đăng nhập</button>
                            <button type="button" value="Hủy" class="btn btn-warning btnClose" data-bs-dismiss="modal">Hủy</button>
                            {!! csrf_field() !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
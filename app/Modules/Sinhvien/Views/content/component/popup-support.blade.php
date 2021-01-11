<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
?>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display:none">
    <div class="modal-dialog modal-dialog-popup" role="document">
        <div class="modal-content bgIndex">
            <div class="modal-title-classic">Gửi phản hồi</div>
            <div class="content-popup-body">
                <div class="contentSupport">
                    <form id="formSendContact" method="POST" class="formSendContact box-form-register" name="txtForm" action="{{ URL::route('site.pageContactPost') }}">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control txtEmail" placeholder="Bạn hãy nhập email" >
                        </div>
                        <div class="form-group ">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" class="form-control txtTitle" placeholder="Nhập tiêu đề" >
                        </div>
                        <div class="form-group ">
                            <label>Nội dung </label>
                            <textarea name="content"  rows="5" class="form-control txtContent" placeholder="Nhập nội dung" ></textarea>
                        </div>
                        <div class="button">
                            <button type="submit" value="Gửi đi" class="btn btn-primary submitContact">Gửi đi</button>
                            <button type="button" value="Hủy" class="btn btn-warning btnClose" data-bs-dismiss="modal">Hủy</button>
                            {!! csrf_field() !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

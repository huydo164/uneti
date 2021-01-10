<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\ThumbImg;
?>
@extends('Admin::layout.html')
@section('header')
    @include('Admin::block.header')
@stop
@section('left')
    @include('Admin::block.left')
@stop
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="{{URL::route('admin.dashboard')}}">Trang chủ</a>
                    </li>
                    <li class="active">@if($id==0)Thêm mới @else Sửa @endif sinh viên</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="row">
                        @if(isset($error) && $error != '')
                            <div class="alert-admin alert alert-danger">{!! $error !!}</div>
                        @endif
                        <form class="form-horizontal paddingTop30" name="txtForm" action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-12">
                                    <div class="nav-tabs-horizontal nav-tabs-inverse" data-plugin="tabs">
                                        <ul class="nav nav-tabs nav-tabs-solid" role="tablist">
                                            <li class="nav-item active" role="presentation">
                                                <a class="nav-link active" data-toggle="tab" href="#tabNoiDung"
                                                   aria-controls="tabNoiDung" role="tab">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                    Nội dung
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content pt-10">
                                            <div class="tab-pane panelDetail active" id="tabNoiDung" role="tabpanel">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Trường học</label>
                                                        <select name="truong_hoc" class="form-control input-sm" id="">
                                                            {!! $optionSchool !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Hệ đào tạo</label>
                                                        <select name="he_dao_tao" class="form-control input-sm" id="">
                                                            {!! $optionTrainSystem !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tên sinh viên<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="ten_sv" value="@if(isset($data['ten_sv'])){{$data['ten_sv']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Mã sinh viên<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="msv" value="@if(isset($data['msv'])){{$data['msv']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Mật khẩu<span>*</span></label>
                                                        <input type="password" class="form-control input-sm" name="password" value="@if(isset($data['password'])){{$data['password']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nhập lại mật khẩu<span>*</span></label>
                                                        <input type="password" class="form-control input-sm" name="sv_re_password" value="@if(isset($data['sv_re_password'])){{$data['sv_re_password']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Số chứng minh thư<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="so_cmt" value="@if(isset($data['so_cmt'])){{$data['so_cmt']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Ngày sinh</label>
                                                        <input type="text" class="form-control input-sm date" name="ngaysinh" value="@if(isset($data['ngaysinh']) && $data['ngaysinh'] > 0 ){{date('d-m-Y',$data['ngaysinh'])}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Giới tính</label>
                                                        <select name="gioi_tinh" class="form-control input-sm" id="">
                                                            {!! $optionGender !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email trường <span>*</span></label>
                                                        <input type="email" class="form-control input-sm" name="email_truong" value="@if(isset($data['email_truong'])){{$data['email_truong']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email cá nhân <span>*</span></label>
                                                        <input type="email" class="form-control input-sm" name="email_ca_nhan" value="@if(isset($data['email_ca_nhan'])){{$data['email_ca_nhan']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Số điện thoại <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="dien_thoai" value="@if(isset($data['dien_thoai'])){{$data['dien_thoai']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Lớp <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="lop" value="@if(isset($data['lop'])){{$data['lop']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Khoa <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="khoa" value="@if(isset($data['khoa'])){{$data['khoa']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Ngành <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="nganh" value="@if(isset($data['nganh'])){{$data['nganh']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">nơi ở</label>
                                                        <input type="text" class="form-control input-sm" name="noi_o" value="@if(isset($data['noi_o'])){{$data['noi_o']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Quốc gia <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="quoc_gia" value="@if(isset($data['quoc_gia'])){{$data['quoc_gia']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Quận huyện<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="quan_huyen" value="@if(isset($data['quan_huyen'])){{$data['quan_huyen']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Xã phường</label>
                                                        <input class="form-control input-sm" name="xa_phuong" value="@if(isset($data['xa_phuong'])){{$data['xa_phuong']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Thứ tự</label>
                                                        <input class="form-control input-sm" name="sv_order_no" value="@if(isset($data['sv_order_no'])){{$data['sv_order_no']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Trạng thái</label>
                                                        <select name="sv_status" class="form-control input-sm" id="">
                                                            {!! $optionStatus !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nổi bật</label>
                                                        <select name="sv_focus" class="form-control input-sm" id="">
                                                            {!! $optionFocus !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Mô tả</label>
                                                        <textarea class="form-control input-sm" name="sv_description">@if(isset($data['sv_description'])){{$data['sv_description']}}@endif</textarea>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="panel-footer clearfix">
                                            <div class="form-inline float-right">
                                                <div class="form-row">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" id="id_hiden" name="id_hiden" value="{{$id}}"/>
                                                    <button type="submit" name="txtSubmit" id="buttonSubmit" class="btn btn-primary btn-sm">Lưu lại</button>
                                                    <button type="reset" class="btn btn-sm">Bỏ qua</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function($){
            jQuery('.date').datetimepicker({
                timepicker:false,
                format:'d-m-Y',
                lang:'vi'
            });
        });
    </script>
@stop

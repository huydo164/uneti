<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\ThumbImg;
use App\Library\PHPDev\FuncLib;
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
                    <li class="active">@if($id==0)Thêm mới @else Sửa @endif Biểu mẫu</li>
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
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Tên biểu mẫu<span>*</span></label>
                                                                <div class="controls">
                                                                    <input type="text" class="form-control input-sm" name="form_title" value="@if(isset($data['form_title'])){{$data['form_title']}}@endif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Biểu mẫu</label>
                                                                <div class="controls">
                                                                    <a href="javascript:;"class="btn btn-primary link-button btn-sm" onclick="UploadAdmin.uploadForm(8);">Upload Form</a>
                                                                    <input name="image_primary" type="hidden" id="image_primary" value="@if(isset($data['form_upload'])){{trim($data['form_upload'])}}@endif">
                                                                </div>
                                                                <div id="sys_show_form">
                                                                    @if(isset($data['form_upload']) && $data['form_upload'] != '')
                                                                        <div class="form-upload" style="display: inline-block; text-align: center" >
                                                                            <p>{{ $data['form_upload'] }}</p>
                                                                            <a href="javascript:void(0);" class='removeForm' onclick="UploadAdmin.removeForm('{{$data['form_id']}}','{{$data['form_upload']}}', '8')">Xóa Form</a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Trạng thái</label>
                                                                <div class="controls">
                                                                    <select class="form-control input-sm" name="form_status">
                                                                        {!! $optionStatus !!}}
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
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

    <div class="modal fade" id="sys_PopupUploadFormOtherPro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Upload Form</h4>
                </div>
                <div class="modal-body">
                    <form name="uploadForm" method="post" action="#" enctype="multipart/form-data">
                        <div class="form_group">
                            <div id="sys_show_button_upload">
                                <div id="sys_mulitplefileuploaderForm" class="btn btn-primary">Upload Form</div>
                            </div>
                            <div id="status"></div>

                            <div class="clearfix"></div>
                            <div class="clearfix" style='margin: 5px 10px; width:100%;'>
                                <div id="div_image_form"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


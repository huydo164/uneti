<?php

use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ThumbImg;
?>
@extends('Sinhvien::layout.html')
@section('header')
    @include('Sinhvien::block.header')
@stop
@section('footer')
    @include('Sinhvien::block.footer')
@stop
@section('content')
    <main id="form">
        <div class="container">
            <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="{{URL::route('indexSinhVien')}}">Trang chủ</a>
                    </li>
                    <li class="active">
                        <i class="fas fa-chevron-right"></i>
                        Biểu mẫu online
                    </li>
                </ul>
            </div>
            <div class="box-form">
                <h3>{!! isset($title_form) ? strip_tags($title_form->info_content) : '' !!}</h3>
                @if(isset($data) && !empty($data))
                    <ul>
                        @foreach($data as $key => $item)
                            <li>
                                <a href="" download="{{FuncLib::getRootPath().'uploads/'.CGlobal::FOLDER_FORM.'/'.$item->form_id.'/'.$item->form_upload}}">{{ $item->form_title }} <span>Download</span></a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </main>
    @include('Statics::content.component.popup-support')
    <script>
        $(document).ready(function () {
            SITE.btnClickPopup();
        });
    </script>
@stop
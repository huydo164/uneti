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
    <main id="pageDetail">
        <section class="container">
            <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="{{URL::route('indexSinhVien')}}">Trang chủ</a>
                    </li>
                    <li class="active">
                        <i class="fas fa-chevron-right"></i>
                        {{$data->statics_title}}
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="box-detail">
                        <h4>{{ $data->statics_title }}</h4>
                        {!! stripcslashes($data->statics_content) !!}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="more-news">
                        <h5>Tin Liên quan</h5>
                        @foreach($dataSame as $key => $item)
                            <a class="title-new" href="{{FuncLib::getBaseUrl()}}member/indexSinhVien/tin/{{$item['statics_id']}}">{{$item->statics_title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('Statics::content.component.popup-support')
    <script>
        $(document).ready(function () {
            SITE.btnClickPopup();
        });
    </script>
@stop
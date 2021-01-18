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
<main id="content">
    <div class="container">
        @if(isset($dataBannerContent) && $dataBannerContent != '')
            <div class="banner">
                @foreach($dataBannerContent as $banner)
                    <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_BANNER, $banner['banner_id'], $banner['banner_image'], 1600, 0, '', true, true)}}" title="{{ $banner['banner_title_show'] }}" alt="">
                @endforeach
            </div>
        @endif
    </div>
    <section id="member-index" >
        <div class="box-member container">
            <h4 class="title-news">Thông báo <span class="total"> {{count($data_cat_1)}} </span> </h4>
            <div class="row">
                <div class="row col-lg-9">
                    @if(isset($data_cat_1) && !empty($data_cat_1))
                        @foreach($data_cat_1 as $key => $item)
                            @if($key == 0)
                                <div class="col-md-6">
                                    <img src="{{ ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 400, 0, '', true, true) }}" title="{{ $item->statics_title }}" class="img-detail" alt="">
                                    <a href="{{FuncLib::getBaseUrl()}}member/indexSinhVien/tin/{{$item['statics_id']}}" class="title-detail"><p>{{ $item->statics_title }}</p></a>
                                    <div class="date">{{date('d-m-Y',$item->statics_created)}}</div>
                                </div>
                            @elseif($key == 1)
                                <div class="col-md-6">
                                    <img src="{{ ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 400, 0, '', true, true) }}" title="{{ $item->statics_title }}" class="img-detail" alt="">
                                    <a href="{{FuncLib::getBaseUrl()}}member/indexSinhVien/tin/{{$item['statics_id']}}" class="title-detail" title="{{$item->statics_title}}"><p>{{ $item->statics_title }}</p></a>
                                    <div class="date">{{date('d-m-Y',$item->statics_created)}}</div>
                                </div>
                            @else
                                <div class="list-notification">
                                    <i class="fas fa-location-arrow"></i>
                                    <a href="{{FuncLib::getBaseUrl()}}member/indexSinhVien/tin/{{$item['statics_id']}}" title="{{$item->statics_title}}">{{ $item->statics_title }}</a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="col-lg-3">
                    @if(isset($data_cat_2))
                        @foreach($data_cat_2 as $item)
                            <div class="content-box2">
                                <div class="img-box2">
                                    <img src="{{ ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 500, 0, '', true, true) }}" title="{{ $item->statics_title }}" alt="">
                                </div>
                                <h4>{{ $item->statics_title }}</h4>
                                <p>{{ $item->statics_intro }}</p>
                            </div>
                        @endforeach
                    @endif
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
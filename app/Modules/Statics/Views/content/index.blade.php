<?php

use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ThumbImg;
?>
@extends('Statics::layout.html')
@section('header')
@include('Statics::block.header')
@stop
@section('footer')
@include('Statics::block.footer')
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
    <section id="box1">
        <div class="container">
            @if(isset($title_dvgv) && !empty($title_dvgv))
                <h3>{{ $title_dvgv->info_intro }}</h3>
            @endif
            <div class="group_box1">
                <div class="row">
                    @if(isset($data_cat_1))
                        @foreach($data_cat_1 as $item)
                            <div class="col-lg-3 col3">
                                <div class="content-box1">
                                    <div class="img-box1">
                                        <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 500, 0, '', true, true)}}" title="{{ $item->statics_title }}" alt="">
                                    </div>
                                    <p>{{ $item->statics_title }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section id="box2">
        <div class="container">
            @if(isset($title_dvsv) && !empty($title_dvsv))
                <h3>{{ $title_dvsv->info_intro }}</h3>
            @endif
            <div class="group-box2">
                <div class="row">
                    @if(isset($data_cat_2))
                        @foreach($data_cat_2 as $item)
                            <div class="col-lg-4 col4">
                                <div class="content-box2">
                                    <div class="img-box2">
                                        <img src="{{ ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 500, 0, '', true, true) }}" title="{{ $item->statics_title }}" alt="">
                                    </div>
                                    <h4>{{ $item->statics_title }}</h4>
                                    <p>{{ $item->statics_intro }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section id="box3">
        <div class="container">
            @if(isset($title_hdsv) && !empty($title_hdsv))
                <h3>{{ $title_hdsv->info_intro }}</h3>
            @endif
            <div class="group_box3">
                @if(isset($data_cat_3))
                    @foreach($data_cat_3 as $item)
                        <div class="content-box3">
                            <div class="text-number @if($item->statics_id == 74) bubble @elseif($item->statics_id == 75) blue @elseif( $item->statics_id == 76) green @elseif($item->statics_id == 77) red @endif" >
                                {{ $item->statics_intro }}
                            </div>
                            <div class="text-box3">
                                {!! stripslashes($item->statics_content) !!}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <section id="box4">
        <div class="container">
            @if(isset($lien_he) && !empty($lien_he))
                <h3>{{ $lien_he->info_title }}</h3>
            @endif
            <p>Nếu bạn có câu hỏi/đề xuất/vấn đề gì, hãy <span class="clickPopup">Gửi phản hồi</span> cho chúng tôi.</p>
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
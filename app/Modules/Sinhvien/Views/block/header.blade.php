<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\ThumbImg;
?>
@if(isset($member) && !empty($member))
    {!! isset($messages) && ($messages != '') ? $messages : '' !!}
    <header id="header">
        <div class="container">
            <div class="top-bar">
                @if(isset($logo) && !empty($logo))
                    <div class="logo-uneti">
                        <a href="" title="{{ $logo->info_title }}">
                            <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $logo->info_id, $logo->info_img, 400, 0 , '', true, true)}}" title="{{ $logo->info_title }}" alt="">
                        </a>
                    </div>
                    <div class="text-logo sm-text">
                        {!! $logo->info_content !!}
                    </div>
                @endif
                <div class="info-user">
                    @if(isset($data) && $data != '')
                        <div class="img-user">
                            <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_SINH_VIEN, $data['sinh_vien_id'], $data['sv_img'], 400, 0 , '', true, true)}}" alt="" title="{{$data['ten_sv']}}">
                        </div>
                        <div class="name-user dropdown-toggle">
                            {{$data['ten_sv']}}
                            <div class="dropdown-show">
                                <a href="">Thông tin cá nhân</a>
                                <a href="{{route('mLogout')}}">Đăng xuất</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <section id="menu">
        <div class="container">
            <ul>
                <li><a href="" title="">Đồ án</a></li>
                <li><a href="">Lịch học</a></li>
                <li><a href="">Biểu mẫu</a></li>
                <li><a href="">Hỏi đáp</a></li>
            </ul>
        </div>
    </section>
@endif
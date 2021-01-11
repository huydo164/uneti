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
                    <h4>Họ và tên: {{ isset($data['ten_sv']) ? $data['ten_sv'] : '' }}</h4>
                    <p> Mã sinh viên: {{ isset($data['msv']) ? $data['msv'] : '' }}</p>
                    <p>Ngành: {{ isset($data['nganh']) ? $data['nganh'] : ''  }}</p>
                    <p>Lớp: {{ isset($data['lop']) ? $data['lop'] : '' }}</p>
                </div>
            </div>
        </div>
    </header>
    <section id="menu">
        <div class="container">
            <ul>
                <li><a href="">Đồ án</a></li>
                <li><a href="">Lịch học</a></li>
                <li><a href="">Biểu mẫu</a></li>
                <li><a href="">Hỏi đáp</a></li>
                <li>
                    <a href="{{route('mLogout')}}">Thoát</a>
                </li>
            </ul>
        </div>
    </section>
@endif
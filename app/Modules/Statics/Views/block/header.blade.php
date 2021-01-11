<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\ThumbImg;
?>
{!! isset($messages) && ($messages != '') ? $messages : '' !!}
@if(isset($error) && $error != '')
    <div class="alert alert-danger">{{$error}}</div>
@endif
<header id="header">
    <div class="container">
        <div class="top-bar">
            @if(isset($logo) && !empty($logo))
                <div class="logo-uneti">
                    <a href="" title="{{ $logo->info_title }}">
                        <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $logo->info_id, $logo->info_img, 400, 0 , '', true, true)}}" title="{{ $logo->info_title }}" alt="">
                    </a>
                </div>
                <div class="text-logo">
                    {!! $logo->info_content !!}
                </div>
            @endif
        </div>
    </div>
</header>
<section id="menu">
    <div class="container">
        <ul>
            @if(isset($arrCategory) && !empty($arrCategory))
                @foreach($arrCategory as $cat)
                    @if($cat->category_menu == CGlobal::status_show && $cat->category_parent_id == 0)
                        <?php $i = 0 ?>
                        @foreach($arrCategory as $sub)
                            @if($sub->category_menu == CGlobal::status_show && $sub->category_parent_id == $cat->category_id)
                                <?php $i++ ?>
                            @endif
                        @endforeach
                        <li @if($cat->category_id == 714) class="popupSV" @endif>
                            <a @if($i > 0) @endif title="{{$cat->category_title}}" href="">
                                {{$cat->category_title}}
                            </a>
                            @if($i > 0)
                                <ul class="submenu">
                                    @foreach($arrCategory as $sub)
                                        @if($sub->category_menu == CGlobal::status_show && $sub->category_parent_id == $cat->category_id)
                                            <li>
                                                <a title="{{$sub->category_title}}" href="">
                                                    {{stripcslashes($sub->category_title)}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            @endif
           @if(isset($member) && !empty($member))
            <li>
                <a href="{{route('mLogout')}}">Thoat</a>
            </li>
             @endif
        </ul>
    </div>
</section>
@include('Statics::content.component.popup-loginMember')
<script>
    $(document).ready(function () {
        SITE.btnLoginUser();
    });
</script>

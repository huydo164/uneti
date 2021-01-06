<?php

use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\ThumbImg;
?>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                @if(isset($footer_left) && !empty($footer_left))
                    <div class="logo-footer">
                        <img src="{{ ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $footer_left->info_id, $footer_left->info_img, 400, 0 , '', true, true) }}" title="{{ $footer_left->info_title }}" alt="">
                    </div>
                    <div class="text-footer">
                        {!! $footer_left->info_content !!}
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                @if(isset($footer_address) && !empty($footer_address))
                    {!! $footer_address->info_content !!}
                @endif
            </div>
        </div>
    </div>
    <button class="btnTop">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

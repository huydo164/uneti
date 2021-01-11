<?php

use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\ThumbImg;
?>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <?php if(isset($footer_left) && !empty($footer_left)): ?>
                    <div class="logo-footer">
                        <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $footer_left->info_id, $footer_left->info_img, 400, 0 , '', true, true)); ?>" title="<?php echo e($footer_left->info_title); ?>" alt="">
                    </div>
                    <div class="text-footer">
                        <?php echo $footer_left->info_content; ?>

                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <?php if(isset($footer_address) && !empty($footer_address)): ?>
                    <?php echo $footer_address->info_content; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
    <button class="btnTop">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>
<?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Sinhvien/Views/block/footer.blade.php ENDPATH**/ ?>
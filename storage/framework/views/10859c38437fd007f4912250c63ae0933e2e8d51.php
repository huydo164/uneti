<?php

use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ThumbImg;
?>

<?php $__env->startSection('header'); ?>
<?php echo $__env->make('Sinhvien::block.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('Sinhvien::block.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<main id="content">
    <div class="container">
        <?php if(isset($dataBannerContent) && $dataBannerContent != ''): ?>
            <div class="banner">
                <?php $__currentLoopData = $dataBannerContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_BANNER, $banner['banner_id'], $banner['banner_image'], 1600, 0, '', true, true)); ?>" title="<?php echo e($banner['banner_title_show']); ?>" alt="">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
    <section id="box1">
        <div class="container">
            <?php if(isset($title_dvgv) && !empty($title_dvgv)): ?>
                <h3><?php echo e($title_dvgv->info_intro); ?></h3>
            <?php endif; ?>
            <div class="group_box1">
                <div class="row">
                    <?php if(isset($data_cat_1)): ?>
                        <?php $__currentLoopData = $data_cat_1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col3">
                                <div class="content-box1">
                                    <div class="img-box1">
                                        <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 500, 0, '', true, true)); ?>" title="<?php echo e($item->statics_title); ?>" alt="">
                                    </div>
                                    <p><?php echo e($item->statics_title); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="box2">
        <div class="container">
            <?php if(isset($title_dvsv) && !empty($title_dvsv)): ?>
                <h3><?php echo e($title_dvsv->info_intro); ?></h3>
            <?php endif; ?>
            <div class="group-box2">
                <div class="row">
                    <?php if(isset($data_cat_2)): ?>
                        <?php $__currentLoopData = $data_cat_2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col4">
                                <div class="content-box2">
                                    <div class="img-box2">
                                        <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 500, 0, '', true, true)); ?>" title="<?php echo e($item->statics_title); ?>" alt="">
                                    </div>
                                    <h4><?php echo e($item->statics_title); ?></h4>
                                    <p><?php echo e($item->statics_intro); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="box3">
        <div class="container">
            <?php if(isset($title_hdsv) && !empty($title_hdsv)): ?>
                <h3><?php echo e($title_hdsv->info_intro); ?></h3>
            <?php endif; ?>
            <div class="group_box3">
                <?php if(isset($data_cat_3)): ?>
                    <?php $__currentLoopData = $data_cat_3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="content-box3">
                            <div class="text-number <?php if($item->statics_id == 74): ?> bubble <?php elseif($item->statics_id == 75): ?> blue <?php elseif( $item->statics_id == 76): ?> green <?php elseif($item->statics_id == 77): ?> red <?php endif; ?>" >
                                <?php echo e($item->statics_intro); ?>

                            </div>
                            <div class="text-box3">
                                <?php echo stripslashes($item->statics_content); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section id="box4">
        <div class="container">
            <?php if(isset($lien_he) && !empty($lien_he)): ?>
                <h3><?php echo e($lien_he->info_title); ?></h3>
            <?php endif; ?>
            <p>Nếu bạn có câu hỏi/đề xuất/vấn đề gì, hãy <span class="clickPopup">Gửi phản hồi</span> cho chúng tôi.</p>
        </div>
    </section>
</main>
<?php echo $__env->make('Statics::content.component.popup-support', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function () {
        SITE.btnClickPopup();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Sinhvien::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Sinhvien/Views/content/index.blade.php ENDPATH**/ ?>
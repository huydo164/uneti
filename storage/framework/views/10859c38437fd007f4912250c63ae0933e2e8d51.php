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
    <section id="member-index" >
        <div class="box-member container">
            <h4 class="title-news">Thông báo <span class="total"> <?php echo e(count($data_cat_1)); ?> </span> </h4>
            <div class="row">
                <div class="row col-lg-9">
                    <?php if(isset($data_cat_1) && !empty($data_cat_1)): ?>
                        <?php $__currentLoopData = $data_cat_1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key == 0): ?>
                                <div class="col-md-6">
                                    <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 400, 0, '', true, true)); ?>" title="<?php echo e($item->statics_title); ?>" class="img-detail" alt="">
                                    <a href="<?php echo e(FuncLib::getBaseUrl()); ?>member/indexSinhVien/tin/<?php echo e($item['statics_id']); ?>" class="title-detail"><p><?php echo e($item->statics_title); ?></p></a>
                                    <div class="date"><?php echo e(date('d-m-Y',$item->statics_created)); ?></div>
                                </div>
                            <?php elseif($key == 1): ?>
                                <div class="col-md-6">
                                    <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 400, 0, '', true, true)); ?>" title="<?php echo e($item->statics_title); ?>" class="img-detail" alt="">
                                    <a href="<?php echo e(FuncLib::getBaseUrl()); ?>member/indexSinhVien/tin/<?php echo e($item['statics_id']); ?>" class="title-detail" title="<?php echo e($item->statics_title); ?>"><p><?php echo e($item->statics_title); ?></p></a>
                                    <div class="date"><?php echo e(date('d-m-Y',$item->statics_created)); ?></div>
                                </div>
                            <?php else: ?>
                                <div class="list-notification">
                                    <i class="fas fa-location-arrow"></i>
                                    <a href="<?php echo e(FuncLib::getBaseUrl()); ?>member/indexSinhVien/tin/<?php echo e($item['statics_id']); ?>" title="<?php echo e($item->statics_title); ?>"><?php echo e($item->statics_title); ?></a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3">
                    <?php if(isset($data_cat_2)): ?>
                        <?php $__currentLoopData = $data_cat_2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="content-box2">
                                <div class="img-box2">
                                    <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 500, 0, '', true, true)); ?>" title="<?php echo e($item->statics_title); ?>" alt="">
                                </div>
                                <h4><?php echo e($item->statics_title); ?></h4>
                                <p><?php echo e($item->statics_intro); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
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
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
    <main id="pageDetail">
        <section class="container">
            <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="<?php echo e(URL::route('indexSinhVien')); ?>">Trang chủ</a>
                    </li>
                    <li class="active">
                        <i class="fas fa-chevron-right"></i>
                        <?php echo e($data->statics_title); ?>

                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="box-detail">
                        <h4><?php echo e($data->statics_title); ?></h4>
                        <?php echo stripcslashes($data->statics_content); ?>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="more-news">
                        <h5>Tin Liên quan</h5>
                        <?php $__currentLoopData = $dataSame; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="title-new" href="<?php echo e(FuncLib::getBaseUrl()); ?>member/indexSinhVien/tin/<?php echo e($item['statics_id']); ?>"><?php echo e($item->statics_title); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('Sinhvien::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Sinhvien/Views/content/pageDetail.blade.php ENDPATH**/ ?>
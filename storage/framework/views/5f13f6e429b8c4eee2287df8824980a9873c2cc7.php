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
    <main id="form">
        <div class="container">
            <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="<?php echo e(URL::route('indexSinhVien')); ?>">Trang chủ</a>
                    </li>
                    <li class="active">
                        <i class="fas fa-chevron-right"></i>
                        Biểu mẫu online
                    </li>
                </ul>
            </div>
            <div class="box-form">
                <h3><?php echo isset($title_form) ? strip_tags($title_form->info_content) : ''; ?></h3>
                <?php if(isset($data) && !empty($data)): ?>
                    <ul>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(FuncLib::getRootPath().'uploads/'.CGlobal::FOLDER_FORM.'/'.$item->form_id.'/'.$item->form_upload); ?>" download ><?php echo e($item->form_title); ?> <span>Download</span></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php echo $__env->make('Statics::content.component.popup-support', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function () {
            SITE.btnClickPopup();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Sinhvien::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Sinhvien/Views/content/form.blade.php ENDPATH**/ ?>
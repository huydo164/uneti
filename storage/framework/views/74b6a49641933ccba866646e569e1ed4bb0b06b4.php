<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\ThumbImg;
?>
<?php echo isset($messages) && ($messages != '') ? $messages : ''; ?>

<header id="header">
    <div class="container">
        <div class="top-bar">
            <?php if(isset($logo) && !empty($logo)): ?>
                <div class="logo-uneti">
                    <a href="" title="<?php echo e($logo->info_title); ?>">
                        <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $logo->info_id, $logo->info_img, 400, 0 , '', true, true)); ?>" title="<?php echo e($logo->info_title); ?>" alt="">
                    </a>
                </div>
                <div class="text-logo">
                    <?php echo $logo->info_content; ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
<section id="menu">
    <div class="container">
        <ul>
            <?php if(isset($arrCategory) && !empty($arrCategory)): ?>
                <?php $__currentLoopData = $arrCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($cat->category_menu == CGlobal::status_show && $cat->category_parent_id == 0): ?>
                        <?php $i = 0 ?>
                        <?php $__currentLoopData = $arrCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($sub->category_menu == CGlobal::status_show && $sub->category_parent_id == $cat->category_id): ?>
                                <?php $i++ ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if($cat->category_id == 714): ?> class="popupSV" <?php endif; ?>>
                            <a <?php if($i > 0): ?> <?php endif; ?> title="<?php echo e($cat->category_title); ?>" href="">
                                <?php echo e($cat->category_title); ?>

                            </a>
                            <?php if($i > 0): ?>
                                <ul class="submenu">
                                    <?php $__currentLoopData = $arrCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($sub->category_menu == CGlobal::status_show && $sub->category_parent_id == $cat->category_id): ?>
                                            <li>
                                                <a title="<?php echo e($sub->category_title); ?>" href="">
                                                    <?php echo e(stripcslashes($sub->category_title)); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
           <?php if(isset($member) && !empty($member)): ?>
            <li>
                <a href="<?php echo e(route('mLogout')); ?>">Thoat</a>
            </li>
             <?php endif; ?>
        </ul>
    </div>
</section>
<?php echo $__env->make('Statics::content.component.popup-loginMember', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function () {
        SITE.btnLoginUser();
    });
</script>
<?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Statics/Views/block/header.blade.php ENDPATH**/ ?>
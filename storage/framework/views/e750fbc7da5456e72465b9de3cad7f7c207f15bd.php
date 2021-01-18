<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\ThumbImg;
?>
<?php if(isset($member) && !empty($member)): ?>
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
                    <div class="text-logo sm-text">
                        <?php echo $logo->info_content; ?>

                    </div>
                <?php endif; ?>
                <div class="info-user">
                    <?php if(isset($member) && !empty($member)): ?>
                        <div class="img-user">
                            <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_SINH_VIEN, $member['sinh_vien_id'], $member['sv_img'], 400, 0 , '', true, true)); ?>" alt="" title="<?php echo e($member['ten_sv']); ?>">
                        </div>
                        <div class="name-user dropdown-toggle">
                            <?php echo e($member['ten_sv']); ?>

                            <div class="dropdown-show">
                                <a href="">Thông tin cá nhân</a>
                                <a href="<?php echo e(URL::route('mLogout')); ?>">Đăng xuất</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <section id="menu">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(FuncLib::getBaseURL()); ?>member/indexSinhVien" title="Trang chủ">Trang chủ</a></li>
                <li><a href="" title="">Đồ án</a></li>
                <li><a href="">Lịch học</a></li>
                <li><a href="<?php echo e(FuncLib::getBaseUrl()); ?>member/indexSinhVien/bieu-mau">Biểu mẫu</a></li>
                <li><a href="">Hỏi đáp</a></li>
            </ul>
        </div>
    </section>
<?php endif; ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Sinhvien/Views/block/header.blade.php ENDPATH**/ ?>
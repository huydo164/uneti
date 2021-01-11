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
                    <h4>Họ và tên: <?php echo e(isset($data['ten_sv']) ? $data['ten_sv'] : ''); ?></h4>
                    <p> Mã sinh viên: <?php echo e(isset($data['msv']) ? $data['msv'] : ''); ?></p>
                    <p>Ngành: <?php echo e(isset($data['nganh']) ? $data['nganh'] : ''); ?></p>
                    <p>Lớp: <?php echo e(isset($data['lop']) ? $data['lop'] : ''); ?></p>
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
                    <a href="<?php echo e(route('mLogout')); ?>">Thoát</a>
                </li>
            </ul>
        </div>
    </section>
<?php endif; ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Sinhvien/Views/block/header.blade.php ENDPATH**/ ?>
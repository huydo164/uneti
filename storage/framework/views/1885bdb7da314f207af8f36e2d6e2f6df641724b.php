<?php
    use App\Library\PHPDev\CGlobal;
?>

<?php $__env->startSection('content'); ?>
    <div class="page-login">
        <div class="wrapp-page-login">
            <div class="box-title-login">
                <span class="cms">CMS</span>
                <span class="white">Control Panel</span>
                <div class="copyright">&copy; <?php if(CGlobal::domain): ?><?php echo e(ucwords(CGlobal::domain)); ?><?php endif; ?></div>
            </div>
            <div class="box-login">
                <div class="form-login">
                    <form method="post" action="" class="formSendLogin">
                        <div class="line-title-form">Vui lòng nhập thông tin</div>
                        <?php if(isset($error) && $error != ''): ?>
                            <div class="alert alert-danger"><?php echo e($error); ?></div>
                        <?php endif; ?>
                        <div class="form-group">
                            <div class="item-line">
                                <input type="text" name="name" class="form-control" placeholder="Tên đăng nhập" <?php if(isset($name)): ?> value="<?php echo e($name); ?>" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="item-line">
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                            </div>
                        </div>
                        <?php echo csrf_field(); ?>

                        <button type="submit" class="btn btn-primary btnLogin">
                            <span class="txt-login">Đăng nhập</span>
                        </button>
                        <a rel="nofollow" href="javascript:void(0)" class="forgotpass">Bạn quên mật khẩu?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::login.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/login/login.blade.php ENDPATH**/ ?>
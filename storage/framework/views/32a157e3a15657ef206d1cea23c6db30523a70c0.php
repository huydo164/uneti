<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\ThumbImg;
?>

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('Admin::block.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left'); ?>
    <?php echo $__env->make('Admin::block.left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo e(URL::route('admin.dashboard')); ?>">Trang chủ</a>
                </li>
                <li class="active"><?php if($id==0): ?>Thêm mới <?php else: ?> Sửa <?php endif; ?> người dùng</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="col-xs-12">
                <div class="row">
                    <?php if(isset($error) && $error != ''): ?>
                        <div class="alert-admin alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form class="form-horizontal paddingTop30" name="txtForm" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-12">
                                <div class="nav-tabs-horizontal nav-tabs-inverse" data-plugin="tabs">
                                    <ul class="nav nav-tabs nav-tabs-solid" role="tablist">
                                        <li class="nav-item active" role="presentation">
                                            <a class="nav-link active" data-toggle="tab" href="#tabNoiDung"
                                               aria-controls="tabNoiDung" role="tab">
                                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                Nội dung
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-10">
                                        <div class="tab-pane panelDetail active" id="tabNoiDung" role="tabpanel">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Họ và tên</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control input-sm" name="user_full_name" value="<?php if(isset($data['user_full_name'])): ?><?php echo e($data['user_full_name']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tên đăng nhập<span>*</span></label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control input-sm" name="user_name" <?php if(isset($data['user_name'])): ?>value="<?php echo e($data['user_name']); ?>" <?php if($id > 0): ?> readonly="readonly" <?php endif; ?> <?php endif; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Mật khẩu</label>
                                                    <div class="controls">
                                                        <input type="password" class="form-control input-sm" name="user_pass">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nhập lại mật khẩu</label>
                                                    <div class="controls">
                                                        <input type="password" class="form-control input-sm" name="re_user_pass">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Số điện thoại</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control input-sm" name="user_phone" value="<?php if(isset($data['user_phone'])): ?><?php echo e($data['user_phone']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control input-sm" name="user_mail" value="<?php if(isset($data['user_mail'])): ?><?php echo e($data['user_mail']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Trạng thái</label>
                                                    <div class="controls">
                                                        <select class="form-control input-sm" name="user_status">
                                                            <?php echo $optionStatus; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Thuộc nhóm quyền</label>
                                                    <div class="controls">
                                                        <select name="user_rid" class="form-control input-sm">
                                                            <?php echo $optionRoleGroup; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer clearfix">
                                        <div class="form-inline float-right">
                                            <div class="form-row">
                                                <?php echo csrf_field(); ?>

                                                <input type="hidden" id="id_hiden" name="id_hiden" value="<?php echo e($id); ?>"/>
                                                <button type="submit" name="txtSubmit" id="buttonSubmit" class="btn btn-primary btn-sm">Lưu lại</button>
                                                <button type="reset" class="btn btn-sm">Bỏ qua</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/user/add.blade.php ENDPATH**/ ?>
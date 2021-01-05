<?php
use App\Library\PHPDev\FuncLib;
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
                    <li class="active"><?php if($id==0): ?>Thêm mới <?php else: ?> Sửa <?php endif; ?> quyền</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><b>Danh sách quyền truy cập</b> <span class="red pointer btnClickAllAction"><i>Click chọn tất cả</i></span></label>
                            <div class="controls">
                                <form class="form-horizontal paddingTop30" name="txtForm" action="<?php echo e(FuncLib::getBaseUrl()); ?>admin/role/permission/<?php echo e($id); ?>" method="post">
                                    <?php if(isset($records) && isset($permission)): ?>
                                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($record['name']) && isset($record['sub'])): ?>
                                                <h4 class="theader"><?php echo e($record['name']); ?></h4>
                                                <div class="row">
                                                    <?php $__currentLoopData = $record['sub']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <label class="middle col-lg-2 col-md-3 col-sm-4 item-permission">
                                                            <input type="checkbox" name="permission_id[<?php echo e($key); ?>][]" value="<?php echo e($v->methods[0]); ?>|<?php echo e($v->uri); ?>" class="ace item_check" <?php if(in_array($v->methods[0].'|'.$v->uri, $permission)): ?> checked="checked" <?php endif; ?> >
                                                            <span class="lbl"> <?php echo e($v->action['permission_name']); ?></span>
                                                            <input type="hidden" name="name[<?php echo e($key); ?>][<?php echo e($v->methods[0]); ?>|<?php echo e($v->uri); ?>]" value="<?php echo e($v->action['permission_name']); ?>">
                                                            <input type="hidden" name="menu[<?php echo e($key); ?>][<?php echo e($v->methods[0]); ?>|<?php echo e($v->uri); ?>]" <?php if(isset($v->action['display_menu'])): ?>value="<?php echo e($v->action['display_menu']); ?>" <?php else: ?> value="0" <?php endif; ?>>
                                                            <input type="hidden" name="action_as[<?php echo e($key); ?>][<?php echo e($v->methods[0]); ?>|<?php echo e($v->uri); ?>]" <?php if(isset($v->action['as'])): ?>value="<?php echo e($v->action['as']); ?>"<?php endif; ?>>
                                                            <input type="hidden" name="show_icon[<?php echo e($key); ?>][<?php echo e($v->methods[0]); ?>|<?php echo e($v->uri); ?>]" <?php if(isset($v->action['display_icon_sub'])): ?>value="<?php echo e($v->action['display_icon_sub']); ?>"<?php endif; ?>>
                                                            <input type="hidden" name="group_name[<?php echo e($key); ?>][<?php echo e($v->methods[0]); ?>|<?php echo e($v->uri); ?>]" value="<?php echo e($record['name']); ?>">
                                                            <input type="hidden" name="group_icon[<?php echo e($key); ?>][<?php echo e($v->methods[0]); ?>|<?php echo e($v->uri); ?>]" <?php if(isset($record['icon'])): ?>value="<?php echo e($record['icon']); ?>" <?php endif; ?> >
                                                        </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mgt10">
                                            <input type="hidden" name="id" value="<?php echo e($id); ?>">
                                            <?php echo csrf_field(); ?>

                                            <button type="submit" name="txtSubmit" id="buttonSubmit" class="btn btn-primary btn-sm">Lưu lại</button>
                                            <button type="reset" class="btn btn-sm">Bỏ qua</button>
                                        </div>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/userRole/permission.blade.php ENDPATH**/ ?>
<?php use App\Library\PHPDev\FuncLib; ?>

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
                <li class="active"><?php if($id==0): ?>Thêm mới <?php else: ?> Sửa <?php endif; ?> thùng rác</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="col-xs-12">
                <div class="row">
                    <?php if($error != ''): ?>
                        <div class="alert-admin alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form id="formListItem" class="form-horizontal paddingTop30 trash" name="txtForm" action="<?php echo e(FuncLib::getBaseUrl()); ?>admin/trash/delete" method="post" enctype="multipart/form-data">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5 pull-left text-left">
                                        <input class="checkItem trash" name="checkItem[]" value="<?php echo e($id); ?>" type="checkbox">
                                    </div>
                                    <div class="col-md-5 pull-right text-right">
                                        <a href="javascript:void(0)" title="Khôi phục" id="restoreMoreItem" class="fa fa-reply fa-admin green"></a>
                                        <a href="javascript:void(0)" title="Xóa item" id="deleteMoreItem" class="fa fa-trash fa-admin red"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Lớp: <b><?php if(isset($data['trash_class'])): ?><?php echo e($data['trash_class']); ?><?php endif; ?></b></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Thư mục: <b><?php if(isset($data['trash_folder'])): ?><?php echo e($data['trash_folder']); ?><?php endif; ?></b></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nội dung:</label>
                                <div class="controls content-trash">
                                    <?php
                                    $trash_content = array();
                                    if(isset($data['trash_content'])){
                                        $trash_content = unserialize($data['trash_content']);
                                        foreach($arrField as $field){
                                            if(isset($trash_content[$field])){
                                                echo '<div class="line"><b>'.$field.':</b> '.$trash_content[$field].'</div>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" id="id_hiden" name="id_hiden" value="<?php echo e($id); ?>"/>
                                <button type="reset" class="btn btn-sm">Bỏ qua</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/trash/add.blade.php ENDPATH**/ ?>
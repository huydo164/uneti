<?php
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
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
                    <li class="active">Quản lý sinh viên</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-info <?php if(isset($search['submit']) && $search['submit'] == CGlobal::status_show): ?> act <?php endif; ?>">
                            <form id="frmSearch" method="GET" action="" class="frmSearch" name="frmSearch">
                                <div class="panel-body panel-search">
                                    <div class="form-group col-lg-2">
                                        <label class="control-label">Từ khóa</label>
                                        <div>
                                            <input type="text" class="form-control input-sm" name="ten_sv" <?php if(isset($search['ten_sv']) && $search['ten_sv'] !=''): ?>value="<?php echo e($search['ten_sv']); ?>"<?php endif; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="control-label">Nổi bật</label>
                                        <div>
                                            <select name="sv_focus" class="form-control input-sm">
                                                <?php echo $optionFocus; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="control-label">Trạng thái</label>
                                        <div>
                                            <select name="sv_status" class="form-control input-sm">
                                                <?php echo $optionStatus; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-right">
                                    <a class="btn btn-default btn-sm" class="reset" href="<?php echo e(route('admin.sinh_vien')); ?>"><i class="fa fa-recycle"></i>Bỏ lọc</a>
                                    <a class="btn btn-danger btn-sm" href="<?php echo e(FuncLib::getBaseUrl()); ?>admin/sinh-vien/edit"><i class="ace-icon fa fa-plus-circle"></i>Thêm mới</a>
                                    <button class="btn btn-primary btn-sm" type="submit" name="submit" value="1"><i class="fa fa-search"></i> Tìm kiếm</button>
                                    <a href="javascript:void(0)" title="Xóa item" id="deleteMoreItem" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</a>
                                    <span class="btn btn-warning btn-sm clickSearchDrop">Mở rộng</span>
                                </div>
                            </form>
                        </div>
                        <?php if(isset($messages) && $messages != ''): ?>
                            <?php echo $messages; ?>

                        <?php endif; ?>
                        <?php if(sizeof($data) > 0): ?>
                            <?php if($total>0): ?>
                                <div class="show-bottom-info">
                                    <div class="total-rows">Tổng số: <b><?php echo e($total); ?></b></div>
                                    <div class="list-item-page">
                                        <div class="showListPage"><?php echo $paging; ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <br>
                            <form id="formListItem" method="POST" action="<?php echo e(FuncLib::getBaseUrl()); ?>admin/sinh-vien/delete" class="formListItem" name="txtForm">
                                <table class="table table-bordered table-hover">
                                    <thead class="thin-border-bottom">
                                    <tr>
                                        <th width="2%">STT</th>
                                        <th width="1%">
                                            <label class="pos-rel">
                                                <input id="checkAll" class="ace" type="checkbox">
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th width="20%">Tên sinh viên</th>
                                        <th width="10%">Mã sinh viên</th>
                                        <th width="5%">Thứ tự</th>
                                        <th width="5%">Ngày tạo</th>
                                        <th width="5%">Nổi bật</th>
                                        <th width="5%">Trạng thái</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($k+1); ?></td>
                                            <td>
                                                <label class="pos-rel">
                                                    <input class="ace checkItem" name="checkItem[]" value="<?php echo e($item['sinh_vien_id']); ?>" type="checkbox">
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td><a target="_blank" title="<?php echo e($item->ten_sv); ?>" href=""><?php echo e($item['ten_sv']); ?></a></td>
                                            <td>
                                                <?php if(isset($item['msv'])): ?> <?php echo e($item['msv']); ?> <?php endif; ?>
                                            </td>
                                            <td><?php echo e($item['sv_order_no']); ?></td>
                                            <td><?php echo e(date('d/m/Y', $item['sv_created'])); ?></td>
                                            <td>
                                                <?php if($item['sv_focus'] == '1'): ?>
                                                    <i class="fa fa-check fa-admin green"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-remove fa-admin red"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($item['sv_status'] == '1'): ?>
                                                    <i class="fa fa-check fa-admin green"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-remove fa-admin red"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(FuncLib::getBaseUrl()); ?>admin/sinh-vien/edit/<?php echo e($item['sinh_vien_id']); ?>" title="Cập nhật">
                                                    <i class="fa fa-edit fa-admin"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php if($total>0): ?>
                                    <div class="show-bottom-info">
                                        <div class="total-rows">Tổng số: <b><?php echo e($total); ?></b></div>
                                        <div class="list-item-page">
                                            <div class="showListPage"><?php echo $paging; ?></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php echo csrf_field(); ?>

                            </form>
                        <?php else: ?>
                            <div class="alert">
                                Không có dữ liệu
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/sinhvien/list.blade.php ENDPATH**/ ?>
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
                    <li class="active">Quản lý danh mục</li>
                </ul>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-info <?php if(isset($search['submit']) && $search['submit'] == CGlobal::status_show): ?> act <?php endif; ?>">
                            <form id="frmSearch" method="GET" action="" class="frmSearch" name="frmSearch">
                                <div class="panel-body panel-search">
                                    <div class="form-group col-sm-2">
                                        <label class="control-label">Tên danh mục</label>
                                        <div>
                                            <input  type="text" class="form-control input-sm" name="category_title" <?php if(isset($search['category_title']) && $search['category_title'] !=''): ?>value="<?php echo e($search['category_title']); ?>"<?php endif; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="control-label">Kiểu danh mục</label>
                                        <div>
                                            <select class="form-control input-sm" name="category_type_id">
                                                <?php echo $optionType; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="control-label">Menu ngang</label>
                                        <div>
                                            <select class="form-control input-sm" name="category_menu">
                                                <?php echo $optionMenu; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="control-label">Menu chân trang</label>
                                        <div><select class="form-control input-sm" name="category_menu_footer">
                                                <?php echo $optionFooter; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="control-label">Nổi bật</label>
                                        <div><select class="form-control input-sm" name="category_hot">
                                                <?php echo $optionHot; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="control-label">Trạng thái</label>
                                        <div><select class="form-control input-sm" name="category_status">
                                                <?php echo $optionStatus; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-right">
                                    <a class="btn btn-default btn-sm" class="reset" href="<?php echo e(route('admin.category')); ?>"><i class="fa fa-recycle"></i>Bỏ lọc</a>
                                    <a class="btn btn-danger btn-sm" href="<?php echo e(FuncLib::getBaseUrl()); ?>admin/category/edit"><i class="ace-icon fa fa-plus-circle"></i>Thêm mới</a>
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
                            <form id="formListItem" method="POST" action="<?php echo e(FuncLib::getBaseUrl()); ?>admin/category/delete" class="formListItem" name="txtForm">
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
                                        <th width="10%">Tiêu đề</th>
                                        <th width="8%">Kiểu danh mục</th>
                                        <th width="6%">Menu ngang</th>
                                        <th width="6%">Chân trang</th>
                                        <th width="6%">Nổi bật</th>
                                        <th width="5%">Thứ tự</th>
                                        <th width="5%">Trạng thái</th>
                                        <th width="3%">Ngày tạo</th>
                                        <th width="3%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($item['parent'])): ?>
                                            <tr>
                                                <td><b><?php echo e($k+1); ?></b></td>
                                                <td>
                                                    <label class="pos-rel">
                                                        <input class="ace checkItem" name="checkItem[]" value="<?php echo e($item['parent']['category_id']); ?>" type="checkbox">
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>
                                                <td><b><?php echo e(stripcslashes($item['parent']['category_title'])); ?></b></td>
                                                <td>
                                                    <?php $category_type_id = $item['parent']['category_type_id'] ?>
                                                    <?php if(isset($arrType[$category_type_id])): ?> <?php echo e($arrType[$category_type_id]); ?> <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($item['parent']['category_menu'] == '1'): ?>
                                                        <i class="fa fa-check fa-admin green"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-remove fa-admin red"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($item['parent']['category_menu_footer'] == '1'): ?>
                                                        <i class="fa fa-check fa-admin green"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-remove fa-admin red"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($item['parent']['category_hot'] == '1'): ?>
                                                        <i class="fa fa-check fa-admin green"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-remove fa-admin red"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center"><?php echo e($item['parent']['category_order_no']); ?></td>
                                                <td class="text-center">
                                                    <?php if($item['parent']['category_status'] == '1'): ?>
                                                        <i class="fa fa-check fa-admin green"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-remove fa-admin red"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(date('d/m/Y', $item['parent']['category_created'])); ?></td>
                                                <td>
                                                    <a href="<?php echo e(FuncLib::getBaseUrl()); ?>admin/category/edit/<?php echo e($item['parent']['category_id']); ?>" title="Cập nhật">
                                                        <i class="fa fa-edit fa-admin"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if(!empty($item['sub'])): ?>
                                            <?php $__currentLoopData = $item['sub']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($sub['category_id']); ?></td>
                                                    <td>
                                                        <label class="pos-rel">
                                                            <input class="ace checkItem" name="checkItem[]" value="<?php echo e($sub['category_id']); ?>" type="checkbox">
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td>---<?php echo e(stripcslashes($sub['category_title'])); ?></td>
                                                    <td>
                                                        <?php $sub_category_type_id = $sub['category_type_id'] ?>
                                                        <?php if(isset($arrType[$sub_category_type_id])): ?> <?php echo e($arrType[$sub_category_type_id]); ?> <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if($sub['category_menu'] == '1'): ?>
                                                            <i class="fa fa-check fa-admin green"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-remove fa-admin red"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if($sub['category_menu_footer'] == '1'): ?>
                                                            <i class="fa fa-check fa-admin green"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-remove fa-admin red"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if($sub['category_hot'] == '1'): ?>
                                                            <i class="fa fa-check fa-admin green"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-remove fa-admin red"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center"><?php echo e($sub['category_order_no']); ?></td>
                                                    <td class="text-center">
                                                        <?php if($sub['category_status'] == '1'): ?>
                                                            <i class="fa fa-check fa-admin green"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-remove fa-admin red"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(date('d/m/Y', $sub['category_created'])); ?></td>
                                                    <td>
                                                        <a href="<?php echo e(FuncLib::getBaseUrl()); ?>admin/category/edit/<?php echo e($sub['category_id']); ?>" title="Cập nhật">
                                                            <i class="fa fa-edit fa-admin"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
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
<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/category/list.blade.php ENDPATH**/ ?>
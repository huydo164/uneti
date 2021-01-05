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
                    <li class="active"><?php if($id==0): ?>Thêm mới <?php else: ?> Sửa <?php endif; ?> danh mục</li>
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
                                                        <label class="control-label">Kiểu danh mục</label>
                                                        <select class="form-control input-sm" id="category_type_id" name="category_type_id">
                                                            <?php echo $optionType; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Danh mục cha</label>
                                                        <select class="form-control input-sm" id="category_parent_id" name="category_parent_id">
                                                            <?php echo $strCategoryProduct; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tiêu đề<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="category_title" value="<?php if(isset($data['category_title'])): ?><?php echo e(stripcslashes($data['category_title'])); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Mô tả</label>
                                                        <textarea class="form-control input-sm" name="category_intro"><?php if(isset($data['category_intro'])): ?><?php echo e($data['category_intro']); ?><?php endif; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Liên kết thay thế</label>
                                                        <input type="text" class="form-control input-sm" name="category_link_replace" value="<?php if(isset($data['category_link_replace'])): ?><?php echo e($data['category_link_replace']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Thứ tự</label>
                                                        <input type="text" class="form-control input-sm" name="category_order_no" value="<?php if(isset($data['category_order_no'])): ?><?php echo e($data['category_order_no']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Hiện menu ngang</label>
                                                        <select class="form-control input-sm" name="category_menu">
                                                            <?php echo $optionMenu; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Hiện chân trang</label>
                                                        <select class="form-control input-sm" name="category_menu_footer">
                                                            <?php echo $optionFooter; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nổi bật</label>
                                                        <select class="form-control input-sm" name="category_hot">
                                                            <?php echo $optionHot; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Trạng thái</label>
                                                        <select class="form-control input-sm" name="category_status">
                                                            <?php echo $optionStatus; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Ảnh banner danh mục</label>
                                                        <div class="controls">
                                                            <a href="javascript:;"class="btn btn-primary link-button btn-sm" onclick="UploadAdmin.uploadBannerAdvanced(2);">Ảnh banner danh mục</a>
                                                            <div id="sys_show_image_banner">
                                                                <?php if(isset($data['category_image']) && $data['category_image'] !=''): ?>
                                                                    <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_CATEGORY, $data['category_id'], $data['category_image'], 300, 0, '', true, true)); ?>"/>
                                                                <?php endif; ?>
                                                            </div>
                                                            <input name="img" type="hidden" id="img" <?php if(isset($data['category_image'])): ?>value="<?php echo e($data['category_image']); ?>"<?php endif; ?>>
                                                            <input name="img_old" type="hidden" id="img_old" <?php if(isset($data['category_image'])): ?>value="<?php echo e($data['category_image']); ?>"<?php endif; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta title</label>
                                                        <input type="text" class="form-control input-sm" name="meta_title" value="<?php if(isset($data['meta_title'])): ?><?php echo e($data['meta_title']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta keywords</label>
                                                        <textarea class="form-control input-sm" name="meta_keywords"><?php if(isset($data['meta_keywords'])): ?><?php echo e($data['meta_keywords']); ?><?php endif; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta description</label>
                                                        <textarea class="form-control input-sm" name="meta_description"><?php if(isset($data['meta_description'])): ?><?php echo e($data['meta_description']); ?><?php endif; ?></textarea>
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
    <!--Popup Upload Img-->
    <div class="modal fade" id="sys_PopupUploadImgOtherPro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Upload ảnh</h4>
                </div>
                <div class="modal-body">
                    <form name="uploadImage" method="post" action="#" enctype="multipart/form-data">
                        <div class="form_group">
                            <div id="sys_show_button_upload">
                                <div id="sys_mulitplefileuploader" class="btn btn-primary">Upload ảnh</div>
                            </div>
                            <div id="status"></div>
                            <div class="clearfix"></div>
                            <div class="clearfix" style='margin: 5px 10px; width:100%;'>
                                <div id="div_image"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Popup Upload Img-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/category/add.blade.php ENDPATH**/ ?>
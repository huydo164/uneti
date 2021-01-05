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
                    <li class="active"><?php if($id==0): ?>Thêm mới <?php else: ?> Sửa <?php endif; ?> thông tin chung</li>
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
                                                        <label class="control-label">Tiêu đề<span>*</span></label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control input-sm" name="info_title" value="<?php if(isset($data['info_title'])): ?><?php echo e($data['info_title']); ?><?php endif; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Từ khóa</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control input-sm" name="info_keyword" <?php if(isset($data['info_keyword'])): ?>value="<?php echo e($data['info_keyword']); ?>" <?php if($id > 0): ?> readonly="readonly" <?php endif; ?> <?php endif; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Mô tả</label>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="info_intro"><?php if(isset($data['info_intro'])): ?><?php echo e(stripslashes($data['info_intro'])); ?><?php endif; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Nội dung</label>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="info_content"><?php if(isset($data['info_content'])): ?><?php echo e(stripslashes($data['info_content'])); ?><?php endif; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Thứ tự</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control input-sm" name="info_order_no" value="<?php if(isset($data['info_order_no'])): ?><?php echo e($data['info_order_no']); ?><?php endif; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Trạng thái</label>
                                                        <div class="controls">
                                                            <select class="form-control input-sm" name="info_status">
                                                                <?php echo $optionStatus; ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Ảnh</label>
                                                        <div class="controls">
                                                            <a href="javascript:;"class="btn btn-primary link-button" onclick="UploadAdmin.uploadBannerAdvanced(5);">Upload ảnh</a>
                                                            <div id="sys_show_image_banner">
                                                                <?php if(isset($data['info_img']) && $data['info_img'] !=''): ?>
                                                                    <img src="<?php echo e(ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $data['info_id'], $data['info_img'], 300, 0, '', true, true)); ?>"/>
                                                                <?php endif; ?>
                                                            </div>
                                                            <input name="img" type="hidden" id="img" <?php if(isset($data['info_img'])): ?>value="<?php echo e($data['info_img']); ?>"<?php endif; ?>>
                                                            <input name="img_old" type="hidden" id="img_old" <?php if(isset($data['info_img'])): ?>value="<?php echo e($data['info_img']); ?>"<?php endif; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta title</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control input-sm" name="meta_title" value="<?php if(isset($data['meta_title'])): ?><?php echo e($data['meta_title']); ?><?php endif; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta keyword</label>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="meta_keywords"><?php if(isset($data['meta_keywords'])): ?><?php echo e($data['meta_keywords']); ?><?php endif; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta description</label>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="meta_description"><?php if(isset($data['meta_description'])): ?><?php echo e($data['meta_description']); ?><?php endif; ?></textarea>
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
    <script>
        CKEDITOR.replace('info_content');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/info/add.blade.php ENDPATH**/ ?>
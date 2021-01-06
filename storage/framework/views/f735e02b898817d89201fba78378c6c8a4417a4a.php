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
                    <li class="active"><?php if($id==0): ?>Thêm mới <?php else: ?> Sửa <?php endif; ?> bài viết tĩnh</li>
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
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Danh mục</label>
                                                                <div class="controls">
                                                                    <select class="form-control input-sm" name="statics_catid">
                                                                        <?php echo $optionCategoryProduct; ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Tiêu đề<span>*</span></label>
                                                                <div class="controls">
                                                                    <input type="text" class="form-control input-sm" name="statics_title" value="<?php if(isset($data['statics_title'])): ?><?php echo e($data['statics_title']); ?><?php endif; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Ảnh</label>
                                                                <div class="controls">
                                                                    <a href="javascript:;"class="btn btn-primary link-button btn-sm" onclick="UploadAdmin.uploadMultipleImages(6);">Upload ảnh</a>
                                                                    <input name="image_primary" type="hidden" id="image_primary" value="<?php if(isset($data['statics_image'])): ?><?php echo e(trim($data['statics_image'])); ?><?php endif; ?>">
                                                                </div>
                                                                <!--Hien Thi Anh-->
                                                                <ul id="sys_drag_sort" class="ul_drag_sort">
                                                                    <?php if(isset($news_image_other)): ?>
                                                                        <?php $__currentLoopData = $news_image_other; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li id="sys_div_img_other_<?php echo e($k); ?>">
                                                                                <div class="div_img_upload">
                                                                                    <img src="<?php echo e($v['src_img_other']); ?>" height="80">
                                                                                    <input type="hidden" id="sys_img_other_<?php echo e($k); ?>" name="img_other[]" value="<?php echo e($v['img_other']); ?>" class="sys_img_other">
                                                                                    <div class='clear'></div>
                                                                                    <input type="radio" id="checked_image_<?php echo e($k); ?>" name="checked_image" value="<?php echo e($k); ?>"
                                                                                           <?php if(isset($news_image) && ($news_image == $v['img_other'])): ?> checked="checked" <?php endif; ?>
                                                                                           onclick="UploadAdmin.checkedImage('<?php echo e($v['img_other']); ?>','<?php echo e($k); ?>');">
                                                                                    <label for="checked_image_<?php echo e($k); ?>" style='font-weight:normal'>Ảnh đại diện</label>
                                                                                    <br/>
                                                                                    <a href="javascript:void(0);" id="sys_delete_img_other_<?php echo e($k); ?>" onclick="UploadAdmin.removeImage('<?php echo e($k); ?>', '<?php echo e($data['statics_id']); ?>', '<?php echo e($v['img_other']); ?>', '6');">Xóa ảnh</a>
                                                                                    <span style="display: none"><b><?php echo e($k); ?></b></span>
                                                                                </div>
                                                                            </li>
                                                                            <?php if(isset($news_image) && $news_image == $v['img_other']): ?>
                                                                                <input type="hidden" id="sys_key_image_primary" name="sys_key_image_primary" value="<?php echo e($k); ?>">
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php else: ?>
                                                                        <input type="hidden" id="sys_key_image_primary" name="sys_key_image_primary" value="-1">
                                                                    <?php endif; ?>

                                                                </ul>
                                                                <input name="list1SortOrder" id ='list1SortOrder' type="hidden" />
                                                                <!--Hien Thi Anh-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Mô tả</label>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="statics_intro"><?php if(isset($data['statics_intro'])): ?><?php echo e(stripslashes($data['statics_intro'])); ?><?php endif; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Nội dung</label>
                                                        <div class="controls">
                                                            <button type="button" onclick="UploadAdmin.getInsertImageContent(6, 'open')" class="btn btn-primary btn-sm">Chèn ảnh vào nội dung</button>

                                                            <?php $new_word = (isset($data->statics_word) && $data->statics_word != '') ? json_decode($data->statics_word, true) : []; ?>
                                                        </div>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="statics_content"><?php if(isset($data['statics_content'])): ?><?php echo e(stripslashes($data['statics_content'])); ?><?php endif; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Thứ tự</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control input-sm" name="statics_order_no" value="<?php if(isset($data['statics_order_no'])): ?><?php echo e($data['statics_order_no']); ?><?php endif; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nổi bật</label>
                                                        <div class="controls">
                                                            <select class="form-control input-sm" name="statics_focus">
                                                                <?php echo $optionFocus; ?>}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Trạng thái</label>
                                                        <div class="controls">
                                                            <select class="form-control input-sm" name="statics_status">
                                                                <?php echo $optionStatus; ?>}
                                                            </select>
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
                                                <div class="clearfix"></div>
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

    <!--Popup chen anh vào noi dung-->
    <div class="modal fade" id="sys_PopupImgOtherInsertContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Click ảnh để chèn vào nội dung</h4>
                </div>
                <div class="modal-body">
                    <form name="uploadImage" method="post" action="#" enctype="multipart/form-data">
                        <div class="form_group">
                            <div class="clearfix"></div>
                            <div class="clearfix" style='margin: 5px 10px; width:100%;'>
                                <div id="div_image" class="float_left"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Popup chen anh vào noi dung-->

    <script>
        CKEDITOR.replace('statics_content');
        //Keo Tha Anh
        jQuery("#sys_drag_sort").dragsort({ dragSelector: "div", dragBetween: true, dragEnd: saveOrder });
        function saveOrder() {
            var data = jQuery("#sys_drag_sort li div span").map(function() { return jQuery(this).children().html(); }).get();
            jQuery("input[name=list1SortOrder]").val(data.join(","));
        };
        //Chen Anh Vao Noi Dung
        function insertImgContent(src){
            CKEDITOR.instances.statics_content.insertHtml('<img src="'+src+'"/>');
        }
        insertExtLinkContent();
        function insertExtLinkContent(){
            $('.extLinkClick ul li').click(function(){
                var text = $(this).html();
                CKEDITOR.instances.statics_content.insertHtml(text);
            });
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/statics/add.blade.php ENDPATH**/ ?>
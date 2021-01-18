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
                    <li class="active"><?php if($id==0): ?>Thêm mới <?php else: ?> Sửa <?php endif; ?> sinh viên</li>
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
                                                        <label class="control-label">Trường học</label>
                                                        <select name="truong_hoc" class="form-control input-sm" id="">
                                                            <?php echo $optionSchool; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Hệ đào tạo</label>
                                                        <select name="he_dao_tao" class="form-control input-sm" id="">
                                                            <?php echo $optionTrainSystem; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Ảnh</label>
                                                        <div class="controls">
                                                            <a href="javascript:;"class="btn btn-primary link-button btn-sm" onclick="UploadAdmin.uploadMultipleImages(7);">Upload ảnh</a>
                                                            <input name="image_primary" type="hidden" id="image_primary" value="<?php if(isset($data['sv_img'])): ?><?php echo e(trim($data['sv_img'])); ?><?php endif; ?>">
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
                                                                            <a href="javascript:void(0);" id="sys_delete_img_other_<?php echo e($k); ?>" onclick="UploadAdmin.removeImage('<?php echo e($k); ?>', '<?php echo e($id); ?>', '<?php echo e($v['img_other']); ?>', '7');">Xóa ảnh</a>
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
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tên sinh viên<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="ten_sv" value="<?php if(isset($data['ten_sv'])): ?><?php echo e($data['ten_sv']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Mã sinh viên<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="msv" value="<?php if(isset($data['msv'])): ?><?php echo e($data['msv']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Mật khẩu<span>*</span></label>
                                                        <input type="password" class="form-control input-sm" name="password">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nhập lại mật khẩu<span>*</span></label>
                                                        <input type="password" class="form-control input-sm" name="sv_re_password" value="<?php if(isset($data['sv_re_password'])): ?><?php echo e($data['sv_re_password']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Số chứng minh thư<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="so_cmt" value="<?php if(isset($data['so_cmt'])): ?><?php echo e($data['so_cmt']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Ngày sinh</label>
                                                        <input type="text" class="form-control input-sm date" name="ngaysinh" value="<?php if(isset($data['ngaysinh']) && $data['ngaysinh'] > 0): ?><?php echo e($data['ngaysinh']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Giới tính</label>
                                                        <select name="gioi_tinh" class="form-control input-sm" id="">
                                                            <?php echo $optionGender; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email trường <span>*</span></label>
                                                        <input type="email" class="form-control input-sm" name="email_truong" value="<?php if(isset($data['email_truong'])): ?><?php echo e($data['email_truong']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email cá nhân <span>*</span></label>
                                                        <input type="email" class="form-control input-sm" name="email_ca_nhan" value="<?php if(isset($data['email_ca_nhan'])): ?><?php echo e($data['email_ca_nhan']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Số điện thoại <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="dien_thoai" value="<?php if(isset($data['dien_thoai'])): ?><?php echo e($data['dien_thoai']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Lớp <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="lop" value="<?php if(isset($data['lop'])): ?><?php echo e($data['lop']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Khoa <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="khoa" value="<?php if(isset($data['khoa'])): ?><?php echo e($data['khoa']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Ngành <span>*</span></label>
                                                        <select name="branch_id" class="form-control input-sm" id="">
                                                            <?php echo $optionBranch; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">nơi ở</label>
                                                        <input type="text" class="form-control input-sm" name="noi_o" value="<?php if(isset($data['noi_o'])): ?><?php echo e($data['noi_o']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Quốc gia <span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="quoc_gia" value="<?php if(isset($data['quoc_gia'])): ?><?php echo e($data['quoc_gia']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Quận huyện<span>*</span></label>
                                                        <input type="text" class="form-control input-sm" name="quan_huyen" value="<?php if(isset($data['quan_huyen'])): ?><?php echo e($data['quan_huyen']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Xã phường</label>
                                                        <input class="form-control input-sm" name="xa_phuong" value="<?php if(isset($data['xa_phuong'])): ?><?php echo e($data['xa_phuong']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Thứ tự</label>
                                                        <input class="form-control input-sm" name="sv_order_no" value="<?php if(isset($data['sv_order_no'])): ?><?php echo e($data['sv_order_no']); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Trạng thái</label>
                                                        <select name="sv_status" class="form-control input-sm" id="">
                                                            <?php echo $optionStatus; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nổi bật</label>
                                                        <select name="sv_focus" class="form-control input-sm" id="">
                                                            <?php echo $optionFocus; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Mô tả</label>
                                                        <textarea class="form-control input-sm" name="sv_description"><?php if(isset($data['sv_description'])): ?><?php echo e($data['sv_description']); ?><?php endif; ?></textarea>
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
    <script type="text/javascript">
        jQuery(document).ready(function($){
            jQuery('.date').datetimepicker({
                timepicker:false,
                format:'d-m-Y',
                lang:'vi'
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/sinhvien/add.blade.php ENDPATH**/ ?>
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
                                                        <input type="password" class="form-control input-sm" name="password" value="<?php if(isset($data['password'])): ?><?php echo e($data['password']); ?><?php endif; ?>">
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
                                                        <input type="text" class="form-control input-sm date" name="ngaysinh" value="<?php if(isset($data['ngaysinh']) && $data['ngaysinh'] > 0 ): ?><?php echo e(date('d-m-Y',$data['ngaysinh'])); ?><?php endif; ?>">
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
                                                        <input type="text" class="form-control input-sm" name="nganh" value="<?php if(isset($data['nganh'])): ?><?php echo e($data['nganh']); ?><?php endif; ?>">
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
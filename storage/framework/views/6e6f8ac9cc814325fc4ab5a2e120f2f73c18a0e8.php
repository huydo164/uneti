<?php $__env->startSection('header'); ?>
	<?php echo $__env->make('Admin::block.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left'); ?>
	<?php echo $__env->make('Admin::block.left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="main-content">
		<div class="notification-global">Quản trị nội dung website</div>
		<div class="content-global">
			<?php if($messages != ''): ?>
				<div class="col-lg-12 messages-dash">
					<?php echo $messages; ?>

				</div>
			<?php endif; ?>
			<?php if(isset($menu) && sizeof($menu) > 0): ?>
				<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $sub = isset($item['sub']) ? $item['sub'] : []; ?>
					<?php if(!empty($sub)): ?>
						<?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
								<a href="<?php echo e(URL::route($_sub['permission_as'])); ?>">
									<div class="boder-item padding10 text-center">
										<?php if(isset($_sub['permission_icon']) && $_sub['permission_icon'] != ''): ?>
											<i class="icon-4x <?php echo e($_sub['permission_icon']); ?>"></i>
										<?php endif; ?><br>
										<span><?php echo e($_sub['permission_name']); ?></span>
									</div>
								</a>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin::layout.html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/dashboard/list.blade.php ENDPATH**/ ?>
<?php
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
?>
<div id="sidebar" class="sidebar sidebar-fixed responsive sidebar-scroll" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<a href="<?php echo e(URL::route('admin.dashboard')); ?>" class="btn btn-success">
				<i class="ace-icon fa fa-signal"></i>
			</a>
			<a href="<?php echo e(URL::route('admin.role')); ?>" class="btn btn-info">
				<i class="ace-icon fa fa-pencil"></i>
			</a>
			<a href="<?php echo e(URL::route('admin.user')); ?>" class="btn btn-warning">
				<i class="ace-icon fa fa-users"></i>
			</a>
			<a href="" class="btn btn-danger">
				<i class="ace-icon fa fa-cogs"></i>
			</a>
		</div>
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>
			<span class="btn btn-info"></span>
			<span class="btn btn-warning"></span>
			<span class="btn btn-danger"></span>
		</div>
	</div>
	<ul class="nav nav-list">
		<li class="<?php if(Route::currentRouteName() == 'admin.dashboard'): ?> active <?php endif; ?>">
			<a href="<?php echo e(URL::route('admin.dashboard')); ?>">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Bảng điều khiển</span>
			</a>
			<b class="arrow"></b>
		</li>
		<?php if(isset($menu) && sizeof($menu) > 0): ?>
			<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
				$list_permission_as = [];
				$sub = isset($item['sub']) ? $item['sub'] : [];
				foreach($sub as $action){
					if(isset($action['permission_as'])){
						$list_permission_as[$action['permission_as']] = $action['permission_as'];
					}
				}
				$permission_as = Route::currentRouteName();

				?>
				<li <?php if(in_array($permission_as, $list_permission_as)): ?> class="open" <?php endif; ?>>
					<a href="" <?php if(!empty($sub)): ?>class="dropdown-toggle"<?php endif; ?>>
						<i class="menu-icon <?php echo e(isset($item['icon']) ? $item['icon'] : ''); ?>"></i>
						<b class="menu-text"><?php echo e($key); ?></b>
						<?php if(!empty($sub)): ?>
							<b class="arrow fa fa-angle-down"></b>
						<?php endif; ?>
					</a>
					<b class="arrow"></b>
					<?php if(!empty($sub)): ?>
						<ul class="submenu">
							<?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="<?php if(isset($_sub['permission_as']) && $permission_as == $_sub['permission_as']): ?> active <?php endif; ?>">
									<a href="<?php echo e(URL::route($_sub['permission_as'])); ?>">
										<i class="menu-icon fa fa-caret-right"></i>
										<?php echo e($_sub['permission_name']); ?>

									</a>
									<b class="arrow"></b>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	</ul>
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon"
		   class="ace-icon fa fa-angle-double-left ace-save-state"
		   data-icon1="ace-icon fa fa-angle-double-left"
		   data-icon2="ace-icon fa fa-angle-double-right">
		</i>
	</div>
</div><?php /**PATH D:\wamp64\www\project.vn\uneti1\app\Modules/Admin/Views/block/left.blade.php ENDPATH**/ ?>
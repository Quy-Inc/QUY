<?php if(!request('noheader')): ?>
	<ol class="breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a class="ajax-load" href="<?php echo url('/dashboard'); ?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<?php if($subslug == "0"): ?>
		<li>
			<span style="text-transform: capitalize !important;"><?php echo $name; ?></span>
		</li>
		<?php else: ?>
			<li>
				<a class="ajax-load" href="<?php echo url("/$content->module_slug"); ?>"><?php echo $name; ?></a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<span style="text-transform: capitalize !important;"><?php echo $content->sub_menu->$subslug->name; ?></span>
			</li>			
		<?php endif; ?>
	</ol>
<?php endif; ?>
<?php if($subslug == "0"): ?>
	<?php if(View::exists("$slug.view.home")): ?>
			<?php echo $__env->make("$slug.view.home", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php else: ?>
		<?php echo $__env->make("notfound", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
<?php else: ?>
	<?php if(View::exists("$slug.view.$subslug")): ?>
			<?php echo $__env->make("$slug.view.$subslug", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php else: ?>
		<?php echo $__env->make("$slug.notfound", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
<?php endif; ?>

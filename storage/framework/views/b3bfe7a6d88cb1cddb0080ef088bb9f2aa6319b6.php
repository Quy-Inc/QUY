<ol class="breadcrumb">
		<li><a href="<?php echo url('/dashboard'); ?>" class="ajax-load">Dashboard</a></li>
</ol>
				<!-- //breadcrumb-->
<div id="content" style="padding-top: 0px;">
<div class="row">


<section class="panel">
	<div class="panel-body">
		<header class="panel-heading no-borders">
				<h3><strong>Welcome</strong> <?php echo e(Auth::user()->name); ?> </h3>
		</header>
	</div>
</section>
</div>
</div>

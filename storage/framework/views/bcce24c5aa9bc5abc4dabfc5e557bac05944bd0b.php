<?php
	$mPsbta = new \Modules\psbta\models\Psbta;
	$sum = $mPsbta::sum('biaya_akhir');
	$biaya = number_format($sum ,0,'.','.');

?>


<style>
	.cd{
		margin-top:10px;
	}

	.panel-primary{
		border:1px solid #878282;
	}
</style>




<ol class="breadcrumb">
		<li><a href="<?php echo url('/dashboard'); ?>" class="ajax-load">Dashboard</a></li>
</ol>
				<!-- //breadcrumb-->
<div id="content" style="padding-top: 0px;">
<div class="row">

<section class="panel">
	<div class="panel-body">
		<header class="panel-heading">
				<h3><strong>Welcome</strong> <?php echo e(Auth::user()->name); ?> </h3>
		</header>

<?php if(Auth::user()->id_profile == 4): ?>
		<div class="col-md-6 cd">
			<div class="well bg-primary">
				<div class="widget-tile">
					<h1><strong>TOTAL </strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">PSB TA</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <?php echo e($mPsbta::count()); ?> Data </h3> 
					<div class="hold-icon"><i class="fa fa-bar-chart-o"></i></div>
				</div>
			</div>
		</div>

		<div class="col-md-6 cd">
			<div class="well bg-success">
				<div class="widget-tile">
					<h1><strong>TOTAL</strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">BIAYA</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <b><?php echo e("Rp. ".$biaya); ?></b> </h3> 
					<div class="hold-icon"><i class="fa fa-money"></i></div>
				</div>
			</div>
		</div>
	</div>
<?php elseif(Auth::user()->id_profile == 5): ?>

<div class="col-md-6 cd">
			<div class="well bg-info">
				<div class="widget-tile">
					<h1><strong>TOTAL </strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">PSB MARKETING</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <?php echo e($mPsbta::count()); ?> Data </h3> 
					<div class="hold-icon"><i class="fa fa-area-chart"></i></div>
				</div>
			</div>
		</div>

		<div class="col-md-6 cd">
			<div class="well bg-success">
				<div class="widget-tile">
					<h1><strong>TOTAL</strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">BIAYA</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <b><?php echo e("Rp. ".$biaya); ?></b> </h3> 
					<div class="hold-icon"><i class="fa fa-money"></i></div>
				</div>
			</div>
		</div>
<?php elseif(Auth::user()->id_profile == 6): ?>

	<div class="col-md-6 cd">
			<div class="well bg-danger">
				<div class="widget-tile">
					<h1><strong>TOTAL </strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">PSB AOM</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <?php echo e($mPsbta::where('approve',1)->count()); ?> Data </h3> 
					<div class="hold-icon"><i class="fa  fa-line-chart"></i></div>
				</div>
			</div>
		</div>
	
	<div class="col-md-6 cd">
			<div class="well bg-success">
				<div class="widget-tile">
					<h1><strong>TOTAL</strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">BIAYA</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <b><?php echo e("Rp. ".$biaya); ?></b> </h3> 
					<div class="hold-icon"><i class="fa fa-money"></i></div>
				</div>
			</div>
		</div>
<?php else: ?>
		<div class="col-md-6 cd">
			<div class="well bg-primary">
				<div class="widget-tile">
					<h1><strong>TOTAL </strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">PSB TA</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <?php echo e($mPsbta::count()); ?> Data </h3> 
					<div class="hold-icon"><i class="fa fa-bar-chart-o"></i></div>
				</div>
			</div>
		</div>


		<div class="col-md-6 cd">
			<div class="well bg-info">
				<div class="widget-tile">
					<h1><strong>TOTAL </strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">PSB MARKETING</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <?php echo e($mPsbta::count()); ?> Data </h3> 
					<div class="hold-icon"><i class="fa fa-area-chart"></i></div>
				</div>
			</div>
		</div>

		<div class="col-md-6 cd">
			<div class="well bg-danger">
				<div class="widget-tile">
					<h1><strong>TOTAL </strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">PSB AOM</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <?php echo e($mPsbta::where('approve',1)->count()); ?> Data </h3> 
					<div class="hold-icon"><i class="fa  fa-line-chart"></i></div>
				</div>
			</div>
		</div>

		<div class="col-md-6 cd">
			<div class="well bg-success">
				<div class="widget-tile">
					<h1><strong>TOTAL</strong></h1>
					<h4 style = "margin-bottom:20px; margin-top:5px;">BIAYA</h4>
					<div class="progress progress-xs progress-white progress-over-tile">
							<div class="progress-bar progress-bar-white">
							</div>
					</div>
						<h3> <b><?php echo e("Rp. ".$biaya); ?></b> </h3> 
					<div class="hold-icon"><i class="fa fa-money"></i></div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

</section>
	
</div>
</div>

<?php
	$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addmapel"):''; ?>

	<section class="panel">
		<header class="panel-heading">
				<h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
				<label class="color"><?php echo $content->module_name; ?></label>
		</header>

		<div class="panel-body">
			<?php echo e(Form::open(array('url' => '/ajax/mapel/addmapeld','class'=>'form-horizontal parsley-validated','id'=>'fmapel'))); ?>


				<div class="form-group">
				 	<?php echo e(Form::label('Pelajaran','',['class'=>'control-label col-md-3'])); ?>

				 	<div class="row col-md-9">
				 		<div class="col-md-6">
				 			<?php echo e(Form::text('pelajaran','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'pelajaran harus diisi'])); ?>

				 		</div>
				 	</div>
				 </div>

				 <div class="form-group">
				  	<?php echo e(Form::label('tahun ajaran','',['class'=>'control-label col-md-3'])); ?>

				  	<div class="row col-md-9">
				  		<div class="col-md-6">
				  			<?php
				  				$tahun_ajaran = ["1" => '2018/2019',"2" => '2017/2018'];
				  			?>
				  				<?php echo e(Form::select('tahun_ajaran',array('' => 'Pilih tahun ajaran') +$tahun_ajaran,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"tahun ajaran Harus dipilih",'id'=>'tahun_ajaran','parsley-error-container'=>'#etahun_ajaran'])); ?>

				  		</div>
				  		<span class="col-md-12" id="etahun_ajaran"></span>
				  	</div>
				  </div>

					<div class="form-group">
					 	<?php echo e(Form::label('kurikulum','',['class'=>'control-label col-md-3'])); ?>

					 	<div class="row col-md-9">
					 		<div class="col-md-6">
					 			<?php
					 				$kurikulum = ["1" => 'KTSP 2006',"2" => 'KTSP 2008',"3" =>'K13'];
					 			?>
					 				<?php echo e(Form::select('kurikulum',array('' => 'Pilih Kurikulum') +$kurikulum,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"kurikulum Harus dipilih",'id'=>'kurikulum','parsley-error-container'=>'#ekurikulum'])); ?>

					 		</div>
					 		<span class="col-md-12" id="ekurikulum"></span>
					 	</div>
					 </div>

			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							<?php echo e(Form::submit('Tambah Mata Pelajaran',['class'=>'btn btn-theme','id'=>'bmapel'])); ?>


							<button type="reset" class="btn" id="reset" onclick="$( '.mapel' ).trigger( 'click')">Cancel</button>
					</div>
			</div>
			<?php echo e(Form::close()); ?>

		</div>
	</section>
</div>
</div>

<script>
$(function(){
	$(".selectpicker").selectpicker();
	$("#fmapel").submit(function(event){
		event.preventDefault();
		if($(this).parsley( 'validate' )){
			var uri = $(this).attr('action');
			$.ajax({
				url: uri, data: $(this).serialize(), type: "POST", dataType: 'json',
				success: function (e) {
						 if (e.status == 0) {
							 $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
						 }else{
							$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
							$(".mapel").trigger('click');
						 }

				}
			});
		}else{
			$.notific8('',{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
			return false;
		}
	});
});
</script>

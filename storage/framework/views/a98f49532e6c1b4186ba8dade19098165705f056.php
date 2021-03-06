<?php
	$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addsiswa"):''; ?>

	<section class="panel">
		<header class="panel-heading">
				<h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
				<label class="color"><?php echo $content->module_name; ?></label>
		</header>

		<div class="panel-body">
			<?php echo e(Form::open(array('url' => '/ajax/siswa/addsiswad','class'=>'form-horizontal parsley-validated','id'=>'fsiswa'))); ?>


			<div class="form-group">
				<?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

				<div class="row col-md-12" style="height: 0px !important;">
				<label class="progress-label col-md-6">NIPD</label>
				<label class="progress-label col-md-6">No. KK</label>
				</div>
			</div>
			<div class="form-group">
				<?php echo e(Form::label('','',['class'=>'control-label col-md-1'])); ?>

				<div class="row col-md-12">
					<div class="col-md-6">
							<?php echo e(Form::text('nipd','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Nomor Induk Peserta Didik Harus diisi'])); ?>

					</div>
					<div class="col-md-6">
						<?php echo e(Form::text('no_kk','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Nomor Kartu Keluarga harus diisi','placeholder'=>'Nomor Induk Kartu Keluarga'])); ?>

					</div>
				</div>
			</div>

			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							<?php echo e(Form::submit('Add Siswa',['class'=>'btn btn-theme','id'=>'bsiswa'])); ?>


							<button type="reset" class="btn" id="reset" onclick="$( '.siswa' ).trigger( 'click')">Back</button>
					</div>
			</div>
			<?php echo e(Form::close()); ?>

		</div>
	</section>
</div>
</div>

<script>
$(function(){
	$("#fsiswa").submit(function(event){
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
							$(".siswa").trigger('click');
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

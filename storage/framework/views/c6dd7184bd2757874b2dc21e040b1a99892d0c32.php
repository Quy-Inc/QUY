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
		<?php echo e(Form::label('Nama Siswa','',['class'=>'control-label col-md-3'])); ?>

		<div class="row col-md-9">
			<div class="col-md-6">
				<?php echo e(Form::text('nama','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Nama siswa harus diisi'])); ?>

			</div>
		</div>
	</div>

	<div class="form-group">
		<?php echo e(Form::label('NIS','',['class'=>'control-label col-md-3'])); ?>

		<div class="row col-md-9">
			<div class="col-md-6">
				<?php echo e(Form::number('nis','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'NIS harus diisi'])); ?>

			</div>
		</div>
	</div>
	

	<div class="form-group">
		<?php echo e(Form::label('Alamat','',['class'=>'control-label col-md-3'])); ?>

		<div class="row col-md-9">
			<div class="col-md-6">
				<?php echo e(Form::textarea('alamat','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Alamat harus diisi'])); ?>

			</div>
		</div>
	</div>


	<div class="form-group">
		<?php echo e(Form::label('Tempat Lahir','',['class'=>'control-label col-md-3'])); ?>

		<div class="row col-md-9">
			<div class="col-md-6">
				<?php echo e(Form::text('tempat_lahir','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Tempat Lahir harus diisi'])); ?>

			</div>
		</div>
	</div>

	<div class="form-group">
		<?php echo e(Form::label('Tanggal Lahir','',['class'=>'control-label col-md-3'])); ?>

		<div class="row col-md-9">
			<div class="col-md-6">
				<?php echo e(Form::date('tgl_lahir','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Tanggal lahir Harus diisi'])); ?>

			</div>
		</div>
	</div>


		<div class="form-group">
			<?php echo e(Form::label('Jenis Kelamin','',['class'=>'control-label col-md-3'])); ?>

			<div class="row col-md-9">
				<div class="col-md-6">
					<?php
						$jenis_kelamin = ["1"=>'Laki-laki',"2"=>'Perempuan'];
					?>
						<?php echo e(Form::select('jenis_kelamin',array('' => 'Pilih Jenis Kelamin') +$jenis_kelamin,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Status jenis_kelamin Harus dipilih",'id'=>'module','parsley-error-container'=>'#e'])); ?>

				</div>
				<span class="col-md-12" id="jenis_kelamin"></span>
			</div>
		</div>

	<div class="form-group">
		<?php echo e(Form::label('Asal Sekolah','',['class'=>'control-label col-md-3'])); ?>

		<div class="row col-md-9">
			<div class="col-md-6">
				<?php echo e(Form::text('asal_sekolah','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Asal Sekolah harus diisi'])); ?>

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
	$(".selectpicker").selectpicker();
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
<?php
	$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addguru"):''; ?>

	<section class="panel">
		<header class="panel-heading">
				<h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
				<label class="color"><?php echo $content->module_name; ?></label>
		</header>

		<div class="panel-body">
			<?php echo e(Form::open(array('url' => '/ajax/guru/addgurud','class'=>'form-horizontal parsley-validated','id'=>'fguru'))); ?>


			<div class="form-group">
			 	<?php echo e(Form::label('Nama','',['class'=>'control-label col-md-3'])); ?>

			 	<div class="row col-md-9">
			 		<div class="col-md-6">
			 			<?php echo e(Form::text('nama','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Nama Guru harus diisi'])); ?>

			 		</div>
			 	</div>
			 </div>

			 <div class="form-group">
			  	<?php echo e(Form::label('NIP','',['class'=>'control-label col-md-3'])); ?>

			  	<div class="row col-md-9">
			  		<div class="col-md-6">
			  			<?php echo e(Form::number('nip','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'NIP harus diisi'])); ?>

			  		</div>
			  	</div>
			  </div>

				<div class="form-group">
				 	<?php echo e(Form::label('Alamat','',['class'=>'control-label col-md-3'])); ?>

				 	<div class="row col-md-9">
				 		<div class="col-md-6">
				 			<?php echo e(Form::textarea('alamat','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Alamat Harus diisi'])); ?>

				 		</div>
				 	</div>
				 </div>

				<div class="form-group">
				 	<?php echo e(Form::label('Mata Pelajaran','',['class'=>'control-label col-md-3'])); ?>

				 	<div class="row col-md-9">
				 		<div class="col-md-6">
				 			<?php
				 				$mapel = Modules\mapel\models\Mapel::pluck('pelajaran','_id')->all();
				 			?>
				 				<?php echo e(Form::select('mapel',array('' => 'Pilih Mata pelajaran') +$mapel,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Mata Pelajaran Harus dipilih",'id'=>'mapel','parsley-error-container'=>'#emapel'])); ?>

				 		</div>
				 		<span class="col-md-12" id="emapel"></span>
				 	</div>
				 </div>


				 <div class="form-group">
				  	<?php echo e(Form::label('Status Kepegawaian','',['class'=>'control-label col-md-3'])); ?>

				  	<div class="row col-md-9">
				  		<div class="col-md-6">
				  			<?php
				  				$status_kepegawaian = ["1"=>'PNS',"2"=>'Honorer'];
				  			?>
				  				<?php echo e(Form::select('status_kepegawaian',array('' => 'Pilih Status kepegawaian') +$status_kepegawaian,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Status status_kepegawaian Harus dipilih",'id'=>'module','parsley-error-container'=>'#e'])); ?>

				  		</div>
				  		<span class="col-md-12" id="status_kepegawaian"></span>
				  	</div>
				  </div>


			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							<?php echo e(Form::submit('Add Guru',['class'=>'btn btn-theme','id'=>'bguru'])); ?>


							<button type="reset" class="btn" id="reset" onclick="$( '.guru' ).trigger( 'click')">Back</button>
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
	$("#fguru").submit(function(event){
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
							$(".guru").trigger('click');
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

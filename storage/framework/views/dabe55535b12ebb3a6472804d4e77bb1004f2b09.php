<?php
	$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addkebutuhankhusus"):''; ?>

	<section class="panel">
		<header class="panel-heading">
				<h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
				<label class="color"><?php echo $content->module_name; ?></label>
		</header>

		<div class="panel-body">
			<?php echo e(Form::open(array('url' => '/ajax/kebutuhankhusus/addkebutuhankhususd','class'=>'form-horizontal parsley-validated','id'=>'fkebutuhankhusus'))); ?>

			<div class="form-group">
				<?php echo e(Form::label('Tipe','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::text('jenis_kebutuhan','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Harus diisi'])); ?>

					</div>
				</div>
			 </div>
			 <div class="form-group">
					<?php echo e(Form::label('Keterangan','',['class'=>'control-label col-md-3'])); ?>

					<div class="row col-md-9">
						<div class="col-md-6">
							<?php echo e(Form::textarea('keterangan','',['class'=>'form-control parsley-validated','parsley-required'=>"false",'parsley-required-message'=>'Parsley Message'])); ?>

						</div>
					</div>
				</div>

			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							<?php echo e(Form::submit('Add Kebutuhankhusus',['class'=>'btn btn-theme','id'=>'bkebutuhankhusus'])); ?>


							<button type="reset" class="btn" id="reset" onclick="$( '.kebutuhankhusus' ).trigger( 'click')">Back</button>
					</div>
			</div>
			<?php echo e(Form::close()); ?>

		</div>
	</section>
</div>
</div>

<script>
$(function(){
	$("#fkebutuhankhusus").submit(function(event){
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
							$(".kebutuhankhusus").trigger('click');
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

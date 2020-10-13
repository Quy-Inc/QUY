<?php
	$subslugs = $subslug;
	$id = Ozn::hashID_decode($data);
	$modul = new \Modules\pendidikanortu\models\Pendidikanortu;
	$datamodul = $modul::where("_id",$id)->get()->first();
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"edituser"):''; ?>

	<section class="panel">
			<header class="panel-heading">
					<h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
					<label class="color"><?php echo $content->module_name; ?></label>
			</header>

			<div class="panel-body">
				<?php echo e(Form::open(array('url' => '/ajax/pendidikanortu/editpendidikanortud','class'=>'form-horizontal','id'=>'feditpendidikanortu'))); ?>

				<?php echo e(Form::hidden("idpendidikanortu",$id)); ?>

				<div class="form-group">
				 	<?php echo e(Form::label('Jenjang Pendidikan','',['class'=>'control-label col-md-3'])); ?>

				 	<div class="row col-md-9">
				 		<div class="col-md-6">
				 			<?php echo e(Form::text('jenjang',$datamodul->jenjang_pendidikan,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Harus diisi'])); ?>

				 		</div>
				 	</div>
				 </div>

					<div class="form-group offset">
							<div class="col-md-offset-3 col-md-9">
									<?php echo e(Form::submit('Update Pendidikanortu',['class'=>'btn btn-theme','id'=>'beditpendidikanortu'])); ?>


									<button type="reset" class="btn" id="reset" onclick="$( '.pendidikanortu' ).trigger( 'click')">Back</button>
							</div>
					</div>
				<?php echo e(Form::close()); ?>

			</div>
	</section>
</div>
</div>
<script>
$(function(){
	$("#feditpendidikanortu").submit(function(event){
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
								$(".pendidikanortu").trigger('click');
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

<?php
	$subslugs = $subslug;
	$id = Ozn::hashID_decode($data);
	$modul = new \Modules\nilai\models\Nilai;
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
				<?php echo e(Form::open(array('url' => '/ajax/nilai/editnilaid','class'=>'form-horizontal','id'=>'feditnilai'))); ?>

				<?php echo e(Form::hidden("idnilai",$id)); ?>


			<div class="form-group">
				<?php echo e(Form::label('Nama Siswa','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::text('nama_siswa',$datamodul->nama_siswa,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Nama Harus diisi'])); ?>

					</div>
				</div>
			</div>

			<div class="form-group">
				<?php echo e(Form::label('Nilai Harian','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::number('harian',$datamodul->harian,['class'=>'form-control parsley-validated','id'=>'harian','parsley-required'=>"true",'parsley-required-message'=>'Nilai harian harus diisi'])); ?>

					</div>
				</div>
			</div>

			<div class="form-group">
				<?php echo e(Form::label('Nilai UTS','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::number('uts',$datamodul->uts,['class'=>'form-control parsley-validated','id'=>'uts','parsley-required'=>"true",'parsley-required-message'=>'Nilai UTS harus diisi'])); ?>

					</div>
				</div>
			</div>


			<div class="form-group">
				<?php echo e(Form::label('Nilai Semester','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::number('semester',$datamodul->semester,['class'=>'form-control parsley-validated','id'=>'semester','parsley-required'=>"true",'parsley-required-message'=>'Nilai Semester Harus diisi'])); ?>

					</div>
				</div>
			</div>

			<div class="form-group">
				<?php echo e(Form::label('Nila Rata-rata','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::number('rerata',$datamodul->rerata,['class'=>'form-control parsley-validated','id'=>'rerata','readonly','parsley-required'=>"true",'parsley-required-message'=>'Nilai Rata-rata harus Diisi'])); ?>

					</div>
				</div>
			</div>

			
				<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
						<?php echo e(Form::submit('Update Nilai',['class'=>'btn btn-theme','id'=>'beditnilai'])); ?>

							<button type="reset" class="btn" id="reset" onclick="$( '.nilai' ).trigger( 'click')">Back</button>
					</div>
				</div>
				<?php echo e(Form::close()); ?>

			</div>
	</section>
</div>
</div>
<script>
	
$(document).ready(function(){
      $("#semester").keyup(function(){ 
        var harian  = parseInt($("#harian").val());
        var uts  = parseInt($("#uts").val());
        var semester  = parseInt($("#semester").val());
        var total = (harian + uts + semester)/3;
        $("#rerata").val(total); 
      }); 
    });
	
$(function(){
	$("#feditnilai").submit(function(event){
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
								$(".nilai").trigger('click');
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
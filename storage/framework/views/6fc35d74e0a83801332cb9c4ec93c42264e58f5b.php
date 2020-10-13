<?php
	$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addvenues"):''; ?>

	<section class="panel">
		<header class="panel-heading">
				<h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
				<label class="color"><?php echo $content->module_name; ?></label>
		</header>
	
		<div class="panel-body">
			<?php echo e(Form::open(array('url' => '/ajax/venues/addvenuesd','class'=>'form-horizontal parsley-validated','id'=>'fvenues'))); ?>

			<input type='hidden' name='id_merchants' value='<?php echo $data; ?>' />
			<div class="form-group">
				<?php echo e(Form::label('Venue Name','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::text('venuename','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Venue Name Must Be Fill In'])); ?>

					</div>
				</div>
			</div>
			<div class="form-group">
				<?php echo e(Form::label('Venue Caption','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::text('venuecaption','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Venue Caption Must Be Fill In'])); ?>

					</div>
				</div>
			</div>

			<div class="form-group photoform">
				<?php echo e(Form::label('Photo','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6" style="margin-bottom: 15px;">
							<input type='text' name='labelfile[]' class='form-control' placeholder='Label Photo'/>
							<span class='btn btn-theme-inverse btnplus'><i class='fa fa-plus'></i></span>
					</div>
					<div class="col-md-10">
						<div class="fileinput fileinput-new" data-provides="fileinput">
						
						<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
							<div>
								<span class="btn btn-default btn-file">
									<span class="fileinput-new">Choice Photo</span><span class="fileinput-exists">Change</span>
									<input type="file" name="file[]" class="parsley-validated"  parsley-filetype-message="Error Message File Type" parsley-filetype="png|jpg|jpeg" parsley-error-container="#efile">
								</span>
								<span class="fileinput-filename">
								</span>
								<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
							</div>
						</div>
						<span id="efile"></span>
					</div>
				</div>
			</div>
			<div class="addphoto">
				
			</div>

			<div class="form-group">
				<?php echo e(Form::label('Contact','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-12 addressi">
						<div class='contactinput' value='1'>
							<?php echo e(Form::text('contact_key[email]','Email',['class'=>'form-control disabledForm contact_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::email('contact_value[email]','',['class'=>'form-control contact_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
					<div class="col-md-12 addressi">
						<div class='contactinput' value='1'>
							<?php echo e(Form::text('contact_key[phone]','Phone',['class'=>'form-control disabledForm contact_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::text('contact_value[phone]','',['class'=>'form-control contact_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<?php echo e(Form::label('Address','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-12 addressi">
						<div class='addressinput' value='1'>
							<?php echo e(Form::text('addressi_key[street]','Street',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::text('addressi_value[street]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
					<div class="col-md-12 addressi">
						<div class='addressinput' value='2'>
							<?php echo e(Form::text('addressi_key[district]','District',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::text('addressi_value[district]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
					<div class="col-md-12 addressi">
						<div class='addressinput' value='3'>
							<?php echo e(Form::text('addressi_key[city]','City',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::text('addressi_value[city]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
					<div class="col-md-12 addressi">
						<div class='addressinput' value='4'>
							<?php echo e(Form::text('addressi_key[province]','Province',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::text('addressi_value[province]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
					<div class="col-md-12 addressi">
						<div class='addressinput' value='5'>
							<?php echo e(Form::text('addressi_key[country]','Country',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::text('addressi_value[country]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
					<div class="col-md-12 addressi">
						<div class='addressinput' value='6'>
							<?php echo e(Form::text('addressi_key[postal]','Postal Code',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::text('addressi_value[postal]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
					<div class="col-md-12 addressi">
						<div class='addressinput' value='7'>
							<?php echo e(Form::text('addressi_key[coordinate]','Coordinate',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled'])); ?>

							<?php echo e(Form::text('addressi_value[coordinate]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In'])); ?>

						</div>
					</div>
				</div>
			
			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							<?php echo e(Form::submit('Add Venues',['class'=>'btn btn-theme','id'=>'bvenues'])); ?>

							
							<button type="reset" class="btn" id="reset" onclick="$( '.venues' ).trigger( 'click')">Back</button>
					</div>
			</div>
			<?php echo e(Form::close()); ?>

		</div>
	</section>
</div>
</div>

<script>
$(function(){
	var idMerchant = "<?php echo e($data); ?>";

    var attrVenuesUrl = "<?php echo url('venues/merchants'); ?>"+"/"+idMerchant;
    var attrVenuesUrlAdd = "<?php echo url('venues/addvenues'); ?>"+"/"+idMerchant;

    $(".venues").attr('href',attrVenuesUrl);
    $(".addvenues").attr('href',attrVenuesUrlAdd);
	
	$('#fvenues').parsley({
			validators: {
				filemaxsize: function() {
					return {
						validate: function (val, max_megabytes, parsleyField) {
							if (!Modernizr.fileapi) { return true; 
						}
				var file = $(parsleyField.element);
			if (file.is(':not(input[type=file])')) {
			console.log("Validation on max file size only works on file input types");
			return true;
		}
			var max_bytes = max_megabytes * BYTES_PER_MEGABYTE, files = file.get(0).files;
			if (files.length == 0) {
				// No file, so valid. (Required check should ensure file is selected)
				return true;
			}
			return files.length == 1  && files[0].size <= max_bytes;
				},
				priority: 3
				};
				},
				filetype: function() {
					return {
					validate: function (val, requirement) {
					var fileExtension = val.split('.').pop();
					var fileExtensionExplode = requirement.split('|');
					var checkExt = fileExtensionExplode.indexOf(fileExtension);
					return fileExtension === fileExtensionExplode[checkExt];
				},
				priority: 2
				};
			}
		},
		messages: {
			filetype: "The File Type not Allowed.",
			requiredfile: "File Required"
		},
		excluded: 'input[type=hidden], :disabled'
	});
	
	$("#fvenues").submit(function(event){
		event.preventDefault();
		event.stopImmediatePropagation();
		if($(this).parsley( 'validate' )){
			var uri = $(this).attr('action');
			var formData = new FormData($(this)[0]);
			$.ajax({
				url: uri,
				type: 'POST',
					data:formData,
					async: false,
					cache: false,
					contentType: false,
					enctype: 'multipart/form-data',
					processData: false,
					success: function (e) {
					if (e.status == 0) {
						$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
					}else{
						$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
						$(".venues").trigger('click');
					}
				}
			});
		}else{
			$.notific8('',{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
			return false;
		}
	});
	

	$(".btnplus").on("click",function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		e.stopPropagation();

		var photoFormItems = $('.photoform').length+1;

		
		$(".addphoto").append("<div class=\"form-group photoform\" id='idphotoform"+photoFormItems+"'\"><label class='control-label col-md-3'></label><div class=\"row col-md-9\"><div class=\"col-md-6\" style=\"margin-bottom: 15px;\"><input type='text' name='labelfile[]' class='form-control' placeholder='Label Photo'/><span class='btn btn-theme btnmin' value='"+photoFormItems+"' onClick='removePhoto("+photoFormItems	+");'><i class='fa fa-minus'></i></span></div><div class=\"col-md-10\"><div class=\"fileinput fileinput-new\" data-provides=\"fileinput\"><div class=\"fileinput-preview thumbnail\" data-trigger=\"fileinput\" style=\"width: 200px; height: 150px;\"></div><div><span class=\"btn btn-default btn-file\"><span class=\"fileinput-new\">Choice Photo</span><span class=\"fileinput-exists\">Change</span><input type=\"file\" name=\"file[]\" class=\"parsley-validated\" parsley-filetype-message=\"Error Message File Type\" parsley-filetype=\"png|jpg|jpeg\" parsley-error-container=\"#efile\"></span><span class=\"fileinput-filename\"></span><a href=\"#\" class=\"close fileinput-exists\" data-dismiss=\"fileinput\" style=\"float: none\">&times;</a></div></div><span id=\"efile\"></span></div> </div></div>");

	});

});

function removePhoto(id){
	$("#idphotoform"+id).remove();
}

</script>
<style>
.btnplus, .btnmin
{
	float: right;
    position: absolute;
    top: 0;
    right: 15px;
}
.IDFIELD{
	display: inline-block;
    height: 34px !important;
    padding-top: 8px;
    padding-right: 0px !important;
    margin-right: 0px !important;
    width: auto !important;
	font-weight: 500 !important;
}

.extrai_value,.addressi_value,.contact_value,.activation_value
{
    width: 320px !important;
    float: left;
    margin-right: 10px;
}

.extrai_key,.addressi_key,.contact_key,.activation_key
{
    width: 150px !important;
	float: left;
    margin-right: 10px;
}

.addressi{
	margin-bottom:15px !important;
}

.disabledForm
{
	border: none;
    background-color: white !important;
}
</style>
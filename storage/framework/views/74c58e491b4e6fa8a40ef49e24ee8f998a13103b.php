<?php
	$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
<?php echo (isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addmenucategories"):''; ?>

	<section class="panel">
		<header class="panel-heading">
				<h2><?php echo $content->sub_menu->$subslugs->name; ?> </h2>
				<label class="color"><?php echo $content->module_name; ?></label>
		</header>
	
		<div class="panel-body">
			<?php echo e(Form::open(array('url' => '/ajax/menucategories/addmenucategoriesd','class'=>'form-horizontal parsley-validated','id'=>'fmenucategories'))); ?>


			<input type='hidden' name='id_merchant' value='<?php echo e($data); ?>' />

			<div class="form-group">
				<?php echo e(Form::label('Category Code','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::text('category_name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Category Name Must Be Fill In'])); ?>

					</div>
				</div>
			</div>

			<div class="form-group">
				<?php echo e(Form::label('Caption','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::text('caption','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Category Must Be Fill In'])); ?>

					</div>
				</div>
			</div>

			<div class="form-group">
				<?php echo e(Form::label('Description','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::textarea('description','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Description Must Be Fill In'])); ?>

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
				<?php echo e(Form::label('Extra Information','',['class'=>'control-label col-md-3'])); ?>

				<div class="row col-md-9">
					<div class="col-md-6">
						<?php echo e(Form::text('extra_information','',['class'=>'form-control'])); ?>

					</div>
				</div>
			</div>
			
			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							<?php echo e(Form::submit('Add Category',['class'=>'btn btn-theme','id'=>'bmenucategories'])); ?>

							
							<button type="reset" class="btn" id="reset" onclick="$( '.menucategories' ).trigger( 'click')">Back</button>
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

    var attrMenuCategoriesUrl = "<?php echo url('menucategories/menuscategorieslists'); ?>"+"/"+idMerchant;
    var attrMenuCategoriesUrlAdd = "<?php echo url('menucategories/addmenucategories'); ?>"+"/"+idMerchant;

    $(".menucategories").attr('href',attrMenuCategoriesUrl);
    $(".addmenucategories").attr('href',attrMenuCategoriesUrlAdd);

	$('#fmenucategories').parsley({
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
	
	$("#fmenucategories").submit(function(event){
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
						$(".menucategories").trigger('click');
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
</script>
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
    width: 100px !important;
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
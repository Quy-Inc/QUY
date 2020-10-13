@php
	$subslugs = $subslug;
	$id = Ozn::hashID_decode($data);
	$modul = new \Modules\menucategories\models\Menucategories;
	$datamodul = $modul::where("_id",$id)->get()->first(); 
	$idMerchant = $datamodul->merchants->_id;
@endphp

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"edituser"):''!!}
	<section class="panel">
			<header class="panel-heading">
					<h2>{!!$content->sub_menu->$subslugs->name!!} </h2>
					<label class="color">{!!$content->module_name!!}</label>
			</header>
		
			<div class="panel-body">
				{{ Form::open(array('url' => '/ajax/menucategories/editmenucategoriesd','class'=>'form-horizontal','id'=>'feditmenucategories')) }}
				{{Form::hidden("idmenucategories",$id)}}

				<div class="form-group">
					{{ Form::label('Category Code','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6">
							{{ Form::text('category_name',$datamodul->category_name,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Category Name Must Be Fill In']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('Caption','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6">
							{{ Form::text('caption',$datamodul->caption,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Category Must Be Fill In']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('Description','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6">
							{{ Form::textarea('description',$datamodul->description,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Description Must Be Fill In']) }}
						</div>
					</div>
				</div>


				<div class="form-group photoform">
					{{ Form::label('Photo','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6" style="margin-bottom: 15px;">
						<input type='text' name='labelfile[]' class='form-control' placeholder='Label Photo' value='{{$datamodul->photos[0]['label']}}'/>
								<span class='btn btn-theme-inverse btnplus'><i class='fa fa-plus'></i></span>
						</div>
						<div class="col-md-10">
							<div class="fileinput fileinput-new" data-provides="fileinput">
							
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
								<img src='{!!url('public/merchant')."/".$datamodul->photos[0]['photo']!!}' />
							</div>
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
					@php
						$photoCount = count($datamodul->photos);
						if($photoCount > 1)
						{
							foreach ($datamodul->photos as $key => $value) {
								if($key !=0)
								{
									echo "<div class=\"form-group photoform\" id='idphotoform".$key."'\"><label class='control-label col-md-3'></label><div class=\"row col-md-9\"><div class=\"col-md-6\" style=\"margin-bottom: 15px;\"><input type='text' name='labelfile[]' class='form-control' placeholder='Label Photo' value=\"".$datamodul->photos[$key]['label']."\"/><span class='btn btn-theme btnmin' value='".$key."' onClick='removePhoto(".$key.");'><i class='fa fa-minus'></i></span></div><div class=\"col-md-10\"><div class=\"fileinput fileinput-new\" data-provides=\"fileinput\"><div class=\"fileinput-preview thumbnail\" data-trigger=\"fileinput\" style=\"width: 200px; height: 150px;\"><img src='".url('public/merchant')."/".$datamodul->photos[$key]['photo']."' /></div><div><span class=\"btn btn-default btn-file\"><span class=\"fileinput-new\">Choice Photo</span><span class=\"fileinput-exists\">Change</span><input type=\"file\" name=\"file[]\" class=\"parsley-validated\" parsley-filetype-message=\"Error Message File Type\" parsley-filetype=\"png|jpg|jpeg\" parsley-error-container=\"#efile\"></span><span class=\"fileinput-filename\"></span><a href=\"#\" class=\"close fileinput-exists\" data-dismiss=\"fileinput\" style=\"float: none\">&times;</a></div></div><span id=\"efile\"></span></div> </div></div>";
								}
							}
						}
					@endphp
				</div>					
								
				<div class="form-group offset">
						<div class="col-md-offset-3 col-md-9">
								{{ Form::submit('Update Menucategories',['class'=>'btn btn-theme','id'=>'beditmenucategories']) }}
								
								<button type="reset" class="btn" id="reset" onclick="$( '.menucategories' ).trigger( 'click')">Back</button>
						</div>
				</div>
				{{ Form::close() }}
			</div>
	</section>
</div>
</div>
<script>
$(function(){
	
	var idMerchant = "{{$idMerchant}}";

    var attrMenuCategoriesUrl = "{!!url('menucategories/menuscategorieslists')!!}"+"/"+idMerchant;
    var attrMenuCategoriesUrlAdd = "{!!url('menucategories/addmenucategories')!!}"+"/"+idMerchant;

    $(".menucategories").attr('href',attrMenuCategoriesUrl);
    $(".addmenucategories").attr('href',attrMenuCategoriesUrlAdd);


	$('#feditmenucategories').parsley({
			validators: {
				filemaxsize: function() {
					return {
						validate: function (val, max_megabytes, parsleyField) {
							if (!Modernizr.fileapi) { return true; }
							var efile = $(parsleyField.element);
							if (efile.is(':not(input[type=])')) {
								console.log("Validation on max file size only works on file input types");
								return true;
							}
							var max_bytes = max_megabytes * BYTES_PER_MEGABYTE, files = efile.get(0).files;
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
	
	$("#feditmenucategories").submit(function(event){
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

function removePhoto(id){
	$("#idphotoform"+id).remove();
}
</script>

<style>
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

.btnplus, .btnmin
{
	float: right;
    position: absolute;
    top: 0;
    right: 15px;
}
</style>
@php
	$subslugs = $subslug;
	
@endphp

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addmenus"):''!!}
	<section class="panel">
		<header class="panel-heading">
				<h2>{!!$content->sub_menu->$subslugs->name!!} </h2>
				<label class="color">{!!$content->module_name!!}</label>
		</header>
	
		<div class="panel-body">
			{{ Form::open(array('url' => '/ajax/menus/addmenusd','class'=>'form-horizontal parsley-validated','id'=>'fmenus')) }}
			<div class="col-md-6">
				<input type='hidden' name='id_merchant' value='{{$data}}' />
				<div class="form-group">
					{{ Form::label('Kitchen','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-12">
							@php
								$kitchen = Modules\kitchens\models\Kitchens::where("id_merchant",$data)->pluck('kitchen_name','_id')->all();
							@endphp
								{{Form::select('id_kitchen',array('' => 'Choice Kitchen') +$kitchen,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Kitchen Must Be Choice",'id'=>'kitchen','parsley-error-container'=>'#ekitchen'])}}
						</div>
						<span class="col-md-12" id="ekitchen"></span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('Category','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-12">
							@php
								$kitchen = Modules\menucategories\models\Menucategories::where("id_merchant",$data)->pluck('category_name','_id')->all();
							@endphp
								{{Form::select('id_category',array('' => 'Choice Category') +$kitchen,'',['class'=>"selectpicker form-control",'data-live-search'=>'true','data-limit'=>'8','parsley-required'=>"true",'parsley-required-message'=>"Category Must Be Choice",'id'=>'category','parsley-error-container'=>'#ecategory'])}}
						</div>
						<span class="col-md-12" id="ecategory"></span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('Menu Code','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-12">
							{{ Form::text('menu_code','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Menu Code Must Be Fill In']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('Menu Name','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-12">
							{{ Form::text('menu_name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Menu Name Must Be Fill In']) }}
						</div>
					</div>
				</div>
				

				<div class="form-group">
					{{ Form::label('Caption','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-12">
							{{ Form::text('caption','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Must Be Fill In']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('Description','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-12">
							{{ Form::textarea('description','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Description Must Be Fill In']) }}
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-6'>
				<div class="form-group">
					{{ Form::label('Component','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-4">
							{{ Form::text('componentname_','',['placeholder'=>'Name','class'=>'form-control namecomponent']) }}
						</div>
						<div class="col-md-3">
							{{ Form::text('componentamount_','',['placeholder'=>'Amount','class'=>'form-control amountcomponent']) }}
						</div>
						<div class="col-md-4">
							{{ Form::text('componentvalue_','',['placeholder'=>'Value','class'=>'form-control valuecomponent']) }}
						</div>
						<span class='btn btn-primary btn-sm addcomponent'><i class='fa fa-plus'></i></span>
					</div>
				</div>
				<div class='col-md-12 tablecomponent hide'>
					<table class='table table-striped tcomponent'>
						<thead>
							<tr>
								<th width='60%' style='text-align:left !important'>Name</th>
								<th width='20%'>Amount</th>
								<th width='20%'>Value</th>
								<th width='10%'></th>
							</tr>
						</thead>
						<tbody class='component'>
							
						</tbody>
					</table>
				</div>


				<div class="form-group">
					{{ Form::label('Add On Alternative','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-4">
							{{ Form::text('addonalternativename_','',['placeholder'=>'Name','class'=>'form-control nameaddonalternative']) }}
						</div>
						<div class="col-md-3">
							{{ Form::text('addonalternativeamount_','',['placeholder'=>'Amount','class'=>'form-control amountaddonalternative']) }}
						</div>
						<div class="col-md-4">
							{{ Form::text('addonalternativevalue_','',['placeholder'=>'Value','class'=>'form-control valueaddonalternative']) }}
						</div>
						<span class='btn btn-primary btn-sm addaddonalternative'><i class='fa fa-plus'></i></span>
					</div>
				</div>

				<div class='col-md-12 tableaddonalternative hide'>
					<table class='table table-striped taddonalternative'>
						<thead>
							<tr>
								<th width='60%' style='text-align:left !important'>Name</th>
								<th width='20%'>Amount</th>
								<th width='20%'>Value</th>
								<th width='10%'></th>
							</tr>
						</thead>
						<tbody class='addonalternative'>
							
						</tbody>
					</table>
				</div>
				
				<div class="form-group photoform">
				{{ Form::label('Photo','',['class'=>'control-label col-md-2']) }}
				<div class="row col-md-10">
					<div class="col-md-4">
							<input type='text' name='labelfile[]' class='form-control' placeholder='Label Photo'/>
					</div>
					<div class="col-md-4">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div>
								<span class="btn btn-default btn-file">
									<span class="fileinput-new">Choice Photo</span>
									<input type="file" name="file[]" class="parsley-validated"  parsley-filetype-message="Error Message File Type" parsley-filetype="png|jpg|jpeg" parsley-error-container="#efile">
								</span>
								<span class="fileinput-filename">
								</span>
								<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
							</div>
						</div>
						<span id="efile"></span>

					</div>
						<span class='btn btn-sm btn-theme-inverse btnplus'><i class='fa fa-plus'></i></span>

				</div>
			</div>
			<div class="addphoto">	
			</div>

				<div class="form-group" style="margin-top:15px;">
					{{ Form::label('Price','',['class'=>'control-label col-md-2']) }}
					<div class="row col-md-10">
						<div class="col-md-4">
							{{ Form::number('price','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Price Must Be Fill In']) }}
						</div>
					</div>
				</div>

			</div>

			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							{{ Form::submit('Add Menus',['class'=>'btn btn-theme','id'=>'bmenus']) }}
							
							<button type="reset" class="btn" id="reset" onclick="$( '.menus' ).trigger( 'click')">Back</button>
					</div>
			</div>


			{{ Form::close() }}
		</div>
	</section>
</div>
</div>

<script>
$(function(){

	$(".addcomponent").on("click",function(e){
		e.preventDefault();
		e.stopPropagation();
		e.stopImmediatePropagation();
		var namecomponent = $(".namecomponent").val();
		var amountcomponent = $(".amountcomponent").val();
		var valuecomponent = $(".valuecomponent").val();

		var rowCount = $('.tcomponent tbody tr').length;
		var nextCount = rowCount+1;

		if(namecomponent != "" && amountcomponent != "" && valuecomponent != "" )
		{
			var tbodycomponent = "<tr><td align='left'><input type='hidden' name='component["+nextCount+"][name]' value='"+namecomponent+"'/>"+namecomponent+"</td><td align='center'><input type='hidden' name='component["+nextCount+"][amount]' value='"+amountcomponent+"'/>"+amountcomponent+"</td><td align='center'><input type='hidden' name='component["+nextCount+"][value]' value='"+valuecomponent+"'/>"+valuecomponent+"</td><td><span class='btn btn-sm btn-danger removecomponent'><i class='fa fa-minus'></i></span></td></tr>";
			$("tbody.component").prepend(tbodycomponent);
			$(".namecomponent").val("");
			$(".amountcomponent").val("");
			$(".valuecomponent").val("");
		}else{
			alert("Component Must Be Not Empty!");
		}

		var rowCount = $('.tcomponent tbody tr').length;
		if(rowCount > 0)
		{
			$(".tablecomponent").removeClass("hide");
		}else{
			$(".tablecomponent").addClass("hide");
		}

	})

	$(".removecomponent").live('click', function(event) {
		$.when($(this).parent().parent().remove())
		.then(function(e){
			var rowCount = $('.tcomponent tbody tr').length;
			if(rowCount > 0)
			{
				$(".tablecomponent").removeClass("hide");
			}else{
				$(".tablecomponent").addClass("hide");
			}
		});
	});


	$(".addaddonalternative").on("click",function(e){
		e.preventDefault();
		e.stopPropagation();
		e.stopImmediatePropagation();

		var rowCount = $('.taddonalternative tbody tr').length;
		var nextCount = rowCount+1;
		var nameaddonalternative = $(".nameaddonalternative").val();
		var amountaddonalternative = $(".amountaddonalternative").val();
		var valueaddonalternative = $(".valueaddonalternative").val();

		if(nameaddonalternative != "" && amountaddonalternative != "" && valueaddonalternative != "" )
		{
			var tbodyaddonalternative = "<tr><td align='left'><input type='hidden' name='addonalternative["+nextCount+"][name]' value='"+nameaddonalternative+"'/>"+nameaddonalternative+"</td><td align='center'><input type='hidden' name='addonalternative["+nextCount+"][amount]' value='"+amountaddonalternative+"'/>"+amountaddonalternative+"</td><td align='center'><input type='hidden' name='addonalternative["+nextCount+"][value]' value='"+valueaddonalternative+"'/>"+valueaddonalternative+"</td><td><span class='btn btn-sm btn-danger removeaddonalternative'><i class='fa fa-minus'></i></span></td></tr>";
			$("tbody.addonalternative").prepend(tbodyaddonalternative);
			$(".nameaddonalternative").val("");
			$(".amountaddonalternative").val("");
			$(".valueaddonalternative").val("");
		}else{
			alert("addonalternative Must Be Not Empty!");
		}

		
		if(rowCount > 0)
		{
			$(".tableaddonalternative").removeClass("hide");
		}else{
			$(".tableaddonalternative").addClass("hide");
		}

	})

	$(".removeaddonalternative").live('click', function(event) {
		$.when($(this).parent().parent().remove())
		.then(function(e){
			var rowCount = $('.taddonalternative tbody tr').length;
			if(rowCount > 0)
			{
				$(".tableaddonalternative").removeClass("hide");
			}else{
				$(".tableaddonalternative").addClass("hide");
			}
		});
	});

	$(".selectpicker").selectpicker();

	var idMerchant = "{{$data}}";

    var attrMenusUrl = "{!!url('menus/menulists')!!}"+"/"+idMerchant;
    var attrMenusUrlAdd = "{!!url('menus/addmenus')!!}"+"/"+idMerchant;

    $(".menus").attr('href',attrMenusUrl);
    $(".addmenus").attr('href',attrMenusUrlAdd);

	$('#fmenus').parsley({
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
	
	$("#fmenus").submit(function(event){
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
						$(".menus").trigger('click');
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

		
		$(".addphoto").append("<div class=\"form-group photoform\" id='idphotoform"+photoFormItems+"'\"><label class='control-label col-md-2'></label><div class=\"row col-md-10\"><div class=\"col-md-4\"><input type='text' name='labelfile[]' class='form-control' placeholder='Label Photo'/></div><div class=\"col-md-4\"><div class=\"fileinput fileinput-new\" data-provides=\"fileinput\"><div><span class=\"btn btn-default btn-file\"><span class=\"fileinput-new\">Choice Photo</span><input type=\"file\" name=\"file[]\" class=\"parsley-validated\" parsley-filetype-message=\"Error Message File Type\" parsley-filetype=\"png|jpg|jpeg\" parsley-error-container=\"#efile\"></span><span class=\"fileinput-filename\"></span><a href=\"#\" class=\"close fileinput-exists\" data-dismiss=\"fileinput\" style=\"float: none\">&times;</a></div></div><span id=\"efile\"></span></div><span class='btn btn-sm btn-theme btnmin' value='"+photoFormItems+"' onClick='removePhoto("+photoFormItems	+");'><i class='fa fa-minus'></i></span></div></div>");

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
    right: 22px;
}

.photoform,.fileinput
{
	margin-bottom:0px !important;
}
</style>
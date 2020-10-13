@php
	$subslugs = $subslug;
	$id = Ozn::hashID_decode($data);
	$modul = new \Modules\merchants\models\Merchants;
	$datamodul = $modul::where("_id",$id)->get()->first(); 
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
				{{ Form::open(array('url' => '/ajax/merchants/editmerchantsd','class'=>'form-horizontal','id'=>'feditmerchants')) }}
				{{Form::hidden("idmerchants",$id)}}
					
					<div class="form-group">
						{{ Form::label('ID Merchant','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-8">
								{{ Form::text('id_merchant',$datamodul->id_merchant,['class'=>'form-control','disabled'=>'disabled']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Merchant Name','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-8">
								{{ Form::text('merchant_name',$datamodul->merchant_name,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Merchant Name Must Be Filled In']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Company Name','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-8">
								{{ Form::text('company_name',$datamodul->company_name,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Company Name Must Be Filled In']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Caption','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-8">
								{{ Form::text('caption',$datamodul->caption,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Name Must Be Filled In']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Contact','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-12 addressi">
								<div class='contactinput' value='1'>
									{{ Form::text('contact_key[email]','Email',['class'=>'form-control disabledForm contact_key','disabled'=>'disabled']) }}
									{{ Form::email('contact_value[email]',$datamodul->contacts['email'],['class'=>'form-control contact_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In','disabled'=>'disabled']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='contactinput' value='1'>
									{{ Form::text('contact_key[phone]','Phone',['class'=>'form-control disabledForm contact_key','disabled'=>'disabled']) }}
									{{ Form::text('contact_value[phone]',$datamodul->contacts['phone'],['class'=>'form-control contact_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Address','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-12 addressi">
								<div class='addressinput' value='1'>
									{{ Form::text('addressi_key[street]','Street',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[street]',$datamodul->address['street'],['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='2'>
									{{ Form::text('addressi_key[district]','District',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[district]',$datamodul->address['district'],['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='3'>
									{{ Form::text('addressi_key[city]','City',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[city]',$datamodul->address['city'],['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='4'>
									{{ Form::text('addressi_key[province]','Province',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[province]',$datamodul->address['province'],['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='5'>
									{{ Form::text('addressi_key[country]','Country',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[country]',$datamodul->address['country'],['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='6'>
									{{ Form::text('addressi_key[postal]','Postal Code',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[postal]',$datamodul->address['postal'],['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='7'>
									{{ Form::text('addressi_key[coordinate]','Coordinate',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[coordinate]',$datamodul->address['coordinate'],['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('Activation','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-12 addressi">
								<div>
									{{ Form::text('activation_key[is_actived]','Is Actived',['class'=>'form-control disabledForm activation_key','disabled'=>'disabled']) }}
									<div class="ios-switch success pull-left">
											<div class="switch"><input type="checkbox" name='activation_value[is_actived]' {!!($datamodul->activation['is_actived'] == "on")?"checked":""!!}></div>
									</div>
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div>
									{{ Form::text('activation_key[activation_date]','Activation Date',['class'=>'form-control disabledForm activation_key','disabled'=>'disabled']) }}
									{{ Form::text('activation_value[activation_date]',$datamodul->activation['activation_date'],['id'=>'activation_date','class'=>'form-control activation_value parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div>
									{{ Form::text('activation_key[activation_through]','Activation Through',['class'=>'form-control disabledForm activation_key','disabled'=>'disabled']) }}
									{{ Form::text('activation_value[activation_through]',$datamodul->activation['activation_through'],['class'=>'form-control activation_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('Logo','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-10">
								<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
								<img src='{!!url('public/merchant')."/".$datamodul->logo!!}' />
								</div>
									<div>
										<span class="btn btn-default btn-file">
										<span class="fileinput-new">Choice File</span><span class="fileinput-exists">Change</span>
											<input type="file" name="file" class="parsley-validated"  parsley-filetype-message="Error Message File Type" parsley-filetype="png|jpg|jpeg" parsley-error-container="#efile">
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

					<div class="form-group">
						{{ Form::label('Extra Information','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-12">
								<div class='extrai' value='1'>
									{{ Form::text('extrai_key','',['class'=>'form-control extrai_key','placeholder'=>'Information Key']) }}
									{{ Form::text('extrai_value','',['class'=>'form-control extrai_value','placeholder'=>'Information Value']) }}
									<button class='btn btn-sm btn-warning'><i class='fa fa-plus'></i></button>
								</div>
							</div>
						</div>
					</div>
								
					<div class="form-group offset">
							<div class="col-md-offset-3 col-md-9">
									{{ Form::submit('Update Merchants',['class'=>'btn btn-theme','id'=>'beditmerchants']) }}
									
									<button type="reset" class="btn" id="reset" onclick="$( '.merchants' ).trigger( 'click')">Back</button>
							</div>
					</div>
				{{ Form::close() }}
			</div>
	</section>
</div>
</div>
<script>
$(function(){
	$('.switch').bootstrapSwitch();
	$('#activation_date').datetimepicker({
		minView: 2,
		format: 'yyyy-mm-dd'
	});
	$('#feditmerchants').parsley({
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
	
	$("#feditmerchants").submit(function(event){
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
						$(".merchants").trigger('click');
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
</style>
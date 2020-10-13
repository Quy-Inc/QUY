@php
	$subslugs = $subslug;
@endphp

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addmerchants"):''!!}
	<section class="panel">
		<header class="panel-heading">
				<h2>{!!$content->sub_menu->$subslugs->name!!} </h2>
				<label class="color">{!!$content->module_name!!}</label>
		</header>
	
		<div class="panel-body">
			{{ Form::open(array('url' => '/ajax/merchants/addmerchantsd','class'=>'form-horizontal parsley-validated','id'=>'fmerchants')) }}
		
			
				<div class="form-group offset">
					{{-- <div class="form-group">
						{{ Form::label('ID Merchant','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-1 IDFIELD"><h4>QM</h4></div>
							<div class="col-md-2">
								{{ Form::text('id_merchant','',['class'=>'form-control','disabled'=>'disabled']) }}
							</div>
						</div>
					</div> --}}
					<div class="form-group">
						{{ Form::label('Merchant Name','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-8">
								{{ Form::text('merchant_name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Merchant Name Must Be Filled In']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Company Name','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-8">
								{{ Form::text('company_name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Company Name Must Be Filled In']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Caption','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-8">
								{{ Form::text('caption','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Name Must Be Filled In']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('Contact','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-12 addressi">
								<div class='contactinput' value='1'>
									{{ Form::text('contact_key[email]','Email',['class'=>'form-control disabledForm contact_key','disabled'=>'disabled']) }}
									{{ Form::email('contact_value[email]','',['class'=>'form-control contact_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='contactinput' value='1'>
									{{ Form::text('contact_key[phone]','Phone',['class'=>'form-control disabledForm contact_key','disabled'=>'disabled']) }}
									{{ Form::text('contact_value[phone]','',['class'=>'form-control contact_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
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
									{{ Form::text('addressi_value[street]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='2'>
									{{ Form::text('addressi_key[district]','District',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[district]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='3'>
									{{ Form::text('addressi_key[city]','City',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[city]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='4'>
									{{ Form::text('addressi_key[province]','Province',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[province]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='5'>
									{{ Form::text('addressi_key[country]','Country',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[country]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='6'>
									{{ Form::text('addressi_key[postal]','Postal Code',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[postal]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div class='addressinput' value='7'>
									{{ Form::text('addressi_key[coordinate]','Coordinate',['class'=>'form-control disabledForm addressi_key','disabled'=>'disabled']) }}
									{{ Form::text('addressi_value[coordinate]','',['class'=>'form-control addressi_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
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
											<div class="switch"><input type="checkbox" name='activation_value[is_actived]' checked></div>
									</div>
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div>
									{{ Form::text('activation_key[activation_date]','Activation Date',['class'=>'form-control disabledForm activation_key','disabled'=>'disabled']) }}
									{{ Form::text('activation_value[activation_date]','',['id'=>'activation_date','class'=>'form-control activation_value parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
							<div class="col-md-12 addressi">
								<div>
									{{ Form::text('activation_key[activation_through]','Activation Through',['class'=>'form-control disabledForm activation_key','disabled'=>'disabled']) }}
									{{ Form::text('activation_value[activation_through]','',['class'=>'form-control activation_value parsley-validated','parsley-required'=>'true','parsley-required-message'=>'Form Must Be Filled In']) }}
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('Logo','',['class'=>'control-label col-md-3']) }}
						<div class="row col-md-9">
							<div class="col-md-10">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<span class="btn btn-default btn-file">
									<span class="fileinput-new">Choice File</span><span class="fileinput-exists">Change</span>
										<input type="file" name="file" class="parsley-validated"  parsley-filetype-message="Error Message File Type" parsley-filetype="png|jpg|jpeg" parsley-error-container="#efile">
									</span>
									<span class="fileinput-filename">
									</span>
									<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
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
					<div class="col-md-offset-3 col-md-9">
							{{ Form::submit('Add Merchants',['class'=>'btn btn-theme','id'=>'bmerchants']) }}
							
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
	$('#activation_date').datetimepicker({
		minView: 2,
		format: 'yyyy-mm-dd'
	})
	$('#fmerchants').parsley({
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
	
	$("#fmerchants").submit(function(event){
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

	$('.switch').bootstrapSwitch();
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
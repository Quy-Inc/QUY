@php
	$subslugs = $subslug;
@endphp

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addkitchens"):''!!}
	<section class="panel">
		<header class="panel-heading">
				<h2>{!!$content->sub_menu->$subslugs->name!!} </h2>
				<label class="color">{!!$content->module_name!!}</label>
		</header>
	
		<div class="panel-body">
			{{ Form::open(array('url' => '/ajax/kitchens/addkitchensd','class'=>'form-horizontal parsley-validated','id'=>'fkitchens')) }}
			
			<input type='hidden' name='id_merchants' value='{!!$data!!}' />
			
			<div class="form-group">
				{{ Form::label('Kitchen Code','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::text('kitchen_code','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Kitchen Code Must Be Fill In']) }}
					</div>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('Kitchen Name','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::text('kitchen_name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Kitchen Name Must Be Fill In']) }}
					</div>
				</div>
			</div>


			<div class="form-group">
				{{ Form::label('Description','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::textarea('description','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Description Must Be Fill In']) }}
					</div>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('Caption','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::text('caption','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Must Be Fill In']) }}
					</div>
				</div>
			</div>


			<div class="form-group">
				{{ Form::label('Extra Information','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::text('extra_information','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Must Be Fill In']) }}
					</div>
				</div>
			</div>


			
			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							{{ Form::submit('Add Kitchens',['class'=>'btn btn-theme','id'=>'bkitchens']) }}
							
							<button type="reset" class="btn" id="reset" onclick="$( '.kitchens' ).trigger( 'click')">Back</button>
					</div>
			</div>
			{{ Form::close() }}
		</div>
	</section>
</div>
</div>

<script>
$(function(){

	var idMerchant = "{{$data}}";

    var attrKitchensUrl = "{!!url('kitchens/kitchenslists')!!}"+"/"+idMerchant;
    var attrKitchensUrlAdd = "{!!url('kitchens/addkitchents')!!}"+"/"+idMerchant;

    $(".kitchens").attr('href',attrKitchensUrl);
    $(".addkitchens").attr('href',attrKitchensUrlAdd);

	$("#fkitchens").submit(function(event){
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
							$(".kitchens").trigger('click');
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
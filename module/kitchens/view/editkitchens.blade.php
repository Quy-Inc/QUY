@php
	$subslugs = $subslug;
	$id = Ozn::hashID_decode($data);
	$modul = new \Modules\kitchens\models\Kitchens;
	$datamodul = $modul::where("_id",$id)->get()->first();
	$idMerchant = $datamodul->id_merchant;
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
				{{ Form::open(array('url' => '/ajax/kitchens/editkitchensd','class'=>'form-horizontal','id'=>'feditkitchens')) }}
				{{Form::hidden("idkitchens",$id)}}

				<div class="form-group">
					{{ Form::label('ID Kitchen','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6">
							{{ Form::text('id_kitchen',$datamodul->id_kitchen,['class'=>'form-control',"disabled"=>"disabled"]) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('Kitchen Code','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6">
							{{ Form::text('kitchen_code',$datamodul->kitchen_code,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Kitchen Code Must Be Fill In']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('Kitchen Name','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6">
							{{ Form::text('kitchen_name',$datamodul->kitchen_name,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Kitchen Name Must Be Fill In']) }}
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

				<div class="form-group">
					{{ Form::label('Caption','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6">
							{{ Form::text('caption',$datamodul->caption,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Must Be Fill In']) }}
						</div>
					</div>
				</div>


				<div class="form-group">
					{{ Form::label('Extra Information','',['class'=>'control-label col-md-3']) }}
					<div class="row col-md-9">
						<div class="col-md-6">
							{{ Form::text('extra_information',$datamodul->extra_information,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Caption Must Be Fill In']) }}
						</div>
					</div>
				</div>
					
								
				<div class="form-group offset">
						<div class="col-md-offset-3 col-md-9">
								{{ Form::submit('Update Kitchens',['class'=>'btn btn-theme','id'=>'beditkitchens']) }}
								
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

	var idMerchant = "{{$idMerchant}}";

    var attrKitchensUrl = "{!!url('kitchens/kitchenslists')!!}"+"/"+idMerchant;
    var attrKitchensUrlAdd = "{!!url('kitchens/addkitchens')!!}"+"/"+idMerchant;

    $(".kitchens").attr('href',attrKitchensUrl);
    $(".addkitchens").attr('href',attrKitchensUrlAdd);

	$("#feditkitchens").submit(function(event){
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
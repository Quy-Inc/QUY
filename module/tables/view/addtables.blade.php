@php
	$subslugs = $subslug;
	$id = explode("-",$data);
	$idMerchant = $id[0];
	$idVenue = $id[1];
	
@endphp

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addtables"):''!!}
	<section class="panel">
		<header class="panel-heading">
				<h2>{!!$content->sub_menu->$subslugs->name!!} </h2>
				<label class="color">{!!$content->module_name!!}</label>
		</header>
	
		<div class="panel-body">
			{{ Form::open(array('url' => '/ajax/tables/addtablesd','class'=>'form-horizontal parsley-validated','id'=>'ftables')) }}
			
			<input type='hidden' name='id_merchants' value='{!!$idMerchant!!}' />
			<input type='hidden' name='id_venues' value='{!!$idVenue!!}' />

			<div class="form-group">
				{{ Form::label('Table Code','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::text('table_code','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Table Code Must Be Fill In']) }}
					</div>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('Table Name','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::text('table_name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Table Name Must Be Fill In']) }}
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
				{{ Form::label('Description','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::text('description','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Description Must Be Fill In']) }}
					</div>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('Extra Information','',['class'=>'control-label col-md-3']) }}
				<div class="row col-md-9">
					<div class="col-md-6">
						{{ Form::text('extra_information','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Extra Information Must Be Fill In']) }}
					</div>
				</div>
			</div>

			

			
			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							{{ Form::submit('Add Tables',['class'=>'btn btn-theme','id'=>'btables']) }}
							
							<button type="reset" class="btn" id="reset" onclick="$( '.tables' ).trigger( 'click')">Back</button>
					</div>
			</div>
			{{ Form::close() }}
		</div>
	</section>
</div>
</div>

<script>
$(function(){
	$("#md-full-width").modal('hide');

	var idMerchant = "{{$idMerchant}}";
    var idVenue = "{{$idVenue}}";

    var attrStoreUrl = "{!!url('tables/tablelists')!!}"+"/"+idMerchant+"-"+idVenue;
    var attrStoreUrlAdd = "{!!url('tables/addtables')!!}"+"/"+idMerchant+"-"+idVenue;

    $(".tables").attr('href',attrStoreUrl);
    $(".addtables").attr('href',attrStoreUrlAdd);

	$("#ftables").submit(function(event){
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
							$(".tables").trigger('click');
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
@php
	$subslugs = $subslug;
@endphp

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"add$module"):''!!}
	<section class="panel">
		<header class="panel-heading">
				<h2>{!!$content->sub_menu->$subslugs->name!!} </h2>
				<label class="color">{!!$content->module_name!!}</label>
		</header>
	
		<div class="panel-body">
			{{ Form::open(array('url' => '/ajax/$module/add$moduled','class'=>'form-horizontal parsley-validated','id'=>'f$module')) }}
		
			
			<div class="form-group offset">
					<div class="col-md-offset-3 col-md-9">
							{{ Form::submit('Add $modulModels',['class'=>'btn btn-theme','id'=>'b$module']) }}
							
							<button type="reset" class="btn" id="reset" onclick="$( '.$module' ).trigger( 'click')">Back</button>
					</div>
			</div>
			{{ Form::close() }}
		</div>
	</section>
</div>
</div>

<script>
$(function(){
	$("#f$module").submit(function(event){
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
							$(".$module").trigger('click');
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
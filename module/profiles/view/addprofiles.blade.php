<?
$subslugs = $subslug;
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"addprofiles"):''!!}
				<section class="panel">
						<header class="panel-heading">
								<h2>{!!$content->sub_menu->$subslugs->name!!} </h2>
								<label class="color">{!!$content->module_name!!}</label>
						</header>
					
						<div class="panel-body">
							{{ Form::open(array('url' => '/ajax/profiles/addprofilesdata','class'=>'form-horizontal parsley-validated','id'=>'profile-form')) }}
							
								<div class="form-group">
									
									{{ Form::label('Name','',['class'=>'control-label col-md-3']) }}
									<div class="row col-md-9">
										<div class="col-md-6">
											{{ Form::text('name','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Profile Must Be Required']) }}
										</div>
									</div>
								</div>

								<div class="form-group">
									
									{{ Form::label('#ID','',['class'=>'control-label col-md-3']) }}
									<div class="row col-md-9">
										<div class="col-md-6">
											{{ Form::text('idprofile','',['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'#ID Profile Must Be Required']) }}
										</div>
									</div>
								</div>
								
								<div class="form-group offset">
										<div class="col-md-offset-3 col-md-9">
												{{ Form::submit('Add Profile',['class'=>'btn btn-theme']) }}
												<button type="reset" class="btn" onclick="$( '#profile-form' ).parsley( 'destroy' )"> Reset form</button>
										</div>
								</div>
							{{ Form::close() }}
						</div>
				</section>
</div>
</div>

<script>
$(function(){
	$("#profile-form").submit(function(event){
			event.preventDefault();
			if($(this).parsley( 'validate' )){
				var uri = $(this).attr('action');
				var urlback = "{{url('ajax/profiles/addprofiles')}}";
				// send username and password to php check login
				$.ajax({
					url: uri, data: $(this).serialize(), type: "POST", dataType: 'json',
					success: function (e) {
							 if (e.status == 0) { 
								 $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
							 }else{
								$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
								$(".profiles").trigger('click');
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
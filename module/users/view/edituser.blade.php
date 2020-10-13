<?
$subslugs = $subslug;
$csrf = '{ "type": "POST", "dataType": "jsonp", "data": { "_token": "'.csrf_token().'","update":$data}}';
$url = url('ajax/users/getusersinfo?update='.$data);
$id = Ozn::hashID_decode($data);
$UsersDB = new \Modules\users\models\Users;
$getUsersDB = $UsersDB::where("_id",$id)->get()->first();

//echo $csrf;
?>

<div id="content" style="padding-top: 0px;">
	<div class="row">
{!!(isset($content))?Ozn::getSubMenuIcon($content->sub_menu,$content->module_slug,"edituser"):''!!}
				<section class="panel">
						<header class="panel-heading">
								<h2>{!!$content->sub_menu->$subslugs->name!!} </h2>
								<label class="color">{!!$content->module_name!!}</label>
						</header>
					
						<div class="panel-body">
							{{ Form::open(array('url' => '/ajax/users/editusersdata','class'=>'form-horizontal','id'=>'users-form')) }}
							
								<div class="form-group">
									
									{{ Form::label('Name','',['class'=>'control-label col-md-3']) }}
									<div class="row col-md-9">
										<div class="col-md-6">
											{{ Form::text('name',$getUsersDB->name,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Name Required','id'=>'name','tabindex'=>"1"]) }}
										</div>
									</div>
								</div>
								
								<div class="form-group">
									
									{{ Form::label('Username','',['class'=>'control-label col-md-3']) }}
									<div class="row col-md-9">
										<div class="col-md-6">
											{{ Form::text('username',$getUsersDB->username,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Username  Required','parsley-remote-options'=>"$csrf",'parsley-remote'=>"$url",'parsley-remote-message'=>"Username Already Exists",'tabindex'=>"2",'id'=>'username']) }}
										</div>
									</div>
								</div>
								
								
								<div class="form-group">
									
									{{ Form::label('Email','',['class'=>'control-label col-md-3']) }}
									<div class="row col-md-9">
										<div class="col-md-6">
											{{ Form::text('email',$getUsersDB->email,['class'=>'form-control parsley-validated','parsley-required'=>"true",'parsley-required-message'=>'Email Required','parsley-type'=>"email",'parsley-type-email-message'=>'Wrong Email Format','parsley-remote-options'=>"$csrf",'parsley-remote'=>"$url",'parsley-remote-message'=>"Email Already Exists",'id'=>'email','tabindex'=>"3"]) }}
										</div>
									</div>
								</div>
								
								
								<div class="form-group">
									{{ Form::label('Password','',['class'=>'control-label col-md-3']) }}
									<div class="row col-md-9">
											<div class="col-md-6">
												{{ Form::password('password',['class'=>'form-control parsley-validated','id'=>'pass','parsley-minlength'=>'6','tabindex'=>"4"]) }}
											</div>
									</div>
								</div>
								
								<div class="form-group">
									{{ Form::label('Retype -Password','',['class'=>'control-label col-md-3']) }}
									<div class="row col-md-9">
											<div class="col-md-6">
												{{ Form::password('repassword',['class'=>'form-control parsley-validated','parsley-equalto'=>'#pass','tabindex'=>"5",'id'=>'repass']) }}
											</div>
									</div>
								</div>
								
								@if(Auth::user()->id_profile == 1 || Auth::user()->id_profile == 2)
								<div class="form-group">
									{{ Form::label('Profile','',['class'=>'control-label col-md-3']) }}
									<div class="row col-md-9">
											<div class="col-md-6">
											<?
											$Profile = Modules\profiles\models\Profiles::pluck('name','id')->all();
											?>
												{{Form::select('profile',array('0' => 'Select Profiles') +$Profile,$getUsersDB->id_profile,['class'=>"selectpicker form-control",'parsley-min'=>"1",'parsley-min-message'=>"Profile Users Must Be Selected",'tabindex'=>"6",'id'=>'profile'])}}
											</div>
									</div>
								</div>
								@endif
								<div class="form-group offset">
										<div class="col-md-offset-3 col-md-9">
												{{ Form::submit('Update User',['class'=>'btn btn-theme','tabindex'=>"7",'id'=>'submit']) }}
												
												{{ Form::hidden('update',$data) }}
												<button type="reset" class="btn" id="reset" onclick="$( '.jpemilihan' ).trigger( 'click')">Back</button>
										</div>
								</div>
							{{ Form::close() }}
						</div>
				</section>
</div>
</div>
<script>
$(function(){
	$("#users-form").submit(function(event){
			event.preventDefault();
			if($(this).parsley( 'validate' )){
				var uri = $(this).attr('action');
				var urlback = "{{url('ajax/users/editusersdata')}}";
				// send username and password to php check login
				$.ajax({
					url: uri, data: $(this).serialize(), type: "POST", dataType: 'json',
					success: function (e) {
							 if (e.status == 0) { 
								 $.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR ;( "});
							 }else{
								$.notific8(e.message,{ life:5000,horizontalEdge:"bottom", theme:"success" ,heading:" SUCCESS :) "});
								$(".users").trigger('click');
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
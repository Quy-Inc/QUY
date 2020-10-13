<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->
<!-- Title-->
<title>{{env('APP_NAME')}}</title>


<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{!!asset('public/assets/ico/ico_.png')!!}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{!!asset('public/assets/ico/ico_.png')!!}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{!!asset('public/assets/ico/ico_.png')!!}">
<link rel="apple-touch-icon-precomposed" href="{!!asset('public/assets/ico/ico_.png')!!}">
<link rel="shortcut icon" href="{!!asset('public/assets/ico/ico_.png')!!}">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="{{asset('public/assets/css/bootstrap/bootstrap.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('public/assets/css/bootstrap/bootstrap-themes.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('public/assets/css/style.css')}}" />

<!-- Styleswitch if  you don't chang theme , you can delete -->
<link type="text/css" rel="alternate stylesheet" media="screen" title="style1" href="{{asset('public/assets/css/styleTheme1.css')}}" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style2" href="{{asset('public/assets/css/styleTheme2.css')}}" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style3" href="{{asset('public/assets/css/styleTheme3.css')}}" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="{{asset('public/assets/css/styleTheme4.css')}}" />

</head>
<body class="full-lg">

<div id="wrapper">
<div id="loading-top">
		<div id="canvas_loading"></div>
		<span>Checking...</span>
</div>

<div id="main">
		<div class="container">
				<div class="row">
						<div class="col-lg-12">
						
								<div class="account-wall">
										<section class="align-lg-center">
										<div class="site-logo" style="background: url({!!env('APP_LOGO_APP')!!}) no-repeat center center !important;"></div>
										<h4>{{env('APP_NAME')}}</h4>
										</section>
										<form id="form-signin" class="form-signin">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<section class="form-group">
														<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-user"></i></div>
																<input  type="text" class="form-control parsley-validated" name="email" placeholder="Email">
														</div>
														<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-key"></i></div>
																<input type="password" class="form-control parsley-validated" name="password" placeholder="Password">
														</div>
														<section class="form-group" id="error"></section>
														<button class="btn btn-lg btn-warning btn-block" type="submit" id="sign-in" style='font-weight:bold;'>Sign in</button>
												</section>
												
												<section class="clearfix form-group">
														<div class="iCheck pull-left"  data-color="red">
														<input type="checkbox" class="form-control" name="remember"  checked>
														<label>Remember</label>
														</div>
														<a href="#" class="pull-right help">Forget Password? </a>
												</section>
										</form>
										<a href="http://{{env('APP_URL')}}/" target="_blank" class="footer-link">&copy; {!!date('Y',time())!!} | {{env('APP_SITE')}}</a>
								</div>	
								<!-- //account-wall-->
								
						</div>
						<!-- //col-sm-6 col-md-4 col-md-offset-4-->
				</div>
				<!-- //row-->
		</div>
		<!-- //container-->
		
</div>
<!-- //main-->

		
</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		
<!-- Jquery Library -->
<script type="text/javascript" src="{{asset('public/assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/js/jquery.ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/plugins/bootstrap/bootstrap.min.js')}}"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="{{asset('public/assets/js/modernizr/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/plugins/mmenu/jquery.mmenu.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/js/styleswitch.js')}}"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="{{asset('public/assets/plugins/form/form.js')}}"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="{{asset('public/assets/plugins/datetime/datetime.js')}}"></script>
<!-- Library Chart-->
<script type="text/javascript" src="{{asset('public/assets/plugins/chart/chart.js')}}"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="{{asset('public/assets/plugins/pluginsForBS/pluginsForBS.js')}}"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="{{asset('public/assets/plugins/miscellaneous/miscellaneous.js')}}"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="{{asset('public/assets/js/caplet.custom.js')}}"></script>
<script type="text/javascript">
$(function() {
	
			
			//Login animation to center 
			function toCenter(){
					var mainH=$("#main").outerHeight();
					var accountH=$(".account-wall").outerHeight();
					var marginT=(mainH-accountH)/2;
						   if(marginT>30){
							   $(".account-wall").css("margin-top",marginT-15);
							}else{
								$(".account-wall").css("margin-top",30);
							}
				}
				toCenter();
				var toResize;
				$(window).resize(function(e) {
					clearTimeout(toResize);
					toResize = setTimeout(toCenter(), 500);
				});
				
			//Canvas Loading
			  var throbber = new Throbber({  size: 32, padding: 17,  strokewidth: 2.8,  lines: 12, rotationspeed: 0, fps: 15 });
			  throbber.appendTo(document.getElementById('canvas_loading'));
			  throbber.start();	
			
			$("#form-signin").submit(function(event){
					event.preventDefault();
					var username = $('input[name="username"]').val();
					var password = $('input[name="password"]').val();

					if(username !="" && password !="" ){
						var main=$("#main");
						//scroll to top
						main.animate({
							scrollTop: 0
						}, 500);
						main.addClass("slideDown");		
						
						// send username and password to php check login
						$.ajax({
							url: "login", data: $(this).serialize(), type: "POST", dataType: 'json',
							success: function (e) {
									setTimeout(function () { main.removeClass("slideDown") }, !e.status ? 500:3000);
									 if (e.status == 0) { 
										 $.notific8('Check Username or Password again !! ',{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR :); "});
										return false;
									 }else{
										 setTimeout(function () { $("#loading-top span").text("Yes, account is access...") }, 500);
										 setTimeout(function () { $("#loading-top span").text("Redirect to account page...")  }, 1500);
										 directto = e.redir;
										 setTimeout( "window.location.href='"+directto+"'", 3100 );
									 }
									
							}
						});
					}else{
						$.notific8('Check Username or Password again !! ',{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR :); "});
						return false;
					}
			
			});
	});
</script>
<style>
input.parsley-error{
	border:none !important;
}
</style>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

<!-- Title-->
<title><?php echo e(env('APP_NAME')); ?></title>

<!-- Jquery Library -->
<script type="text/javascript" src="<?php echo asset('public/assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('public/assets/js/jquery-ui.js'); ?>"></script>

<script type="text/javascript" src="<?php echo asset('public/assets/jquery.ytLoad-master/jquery.transit.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('public/assets/jquery.ytLoad-master/ytLoad.jquery.js'); ?>"></script>

<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo asset('public/assets/ico/ico_.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo asset('public/assets/ico/ico_.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo asset('public/assets/ico/ico_.png'); ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo asset('public/assets/ico/ico_.png'); ?>">
<link rel="shortcut icon" href="<?php echo asset('public/assets/ico/ico_.png'); ?>">

<!-- CSS Stylesheet-->
<link href="<?php echo asset('public/assets/jquery.ytLoad-master/ytLoad.jquery.css'); ?>" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="<?php echo asset('public/assets/css/bootstrap/bootstrap.min.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo asset('public/assets/css/bootstrap/bootstrap-themes.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo asset('public/assets/css/style.css'); ?>" />

<!-- Styleswitch if  you don't chang theme , you can delete -->
<link type="text/css" rel="alternate stylesheet" media="screen" title="style1" href="<?php echo asset('public/assets/css/styleTheme1.css'); ?>" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style2" href="<?php echo asset('public/assets/css/styleTheme2.css'); ?>" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style3" href="<?php echo asset('public/assets/css/styleTheme3.css'); ?>" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="<?php echo asset('public/assets/css/styleTheme4.css'); ?>" />

</head>
<body class="nav-collapse-in">
<div id="wrapper">
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->
		<div id="header">
		
				<div class="logo-area clearfix">
						<a href="#" class="logo" style="background: url(<?php echo env('APP_LOGO_HOME'); ?>) no-repeat center center;"></a>
				</div>
				<!-- //logo-area-->
				
				<div class="tools-bar">
						<ul class="nav navbar-nav nav-main-xs">
								<li><a href="#menu" class="icon-toolsbar"><i class="fa fa-bars"></i></a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right tooltip-area">
								<li><a href="#" class="avatar-header" data-toggle="tooltip" data-container="body" data-placement="bottom">
												<img alt="" src="<?php echo Gravatar::src(Auth::user()->email); ?>"  class="circle">
										</a>
								</li>
								<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
											<em><strong>Hi</strong>, <?php echo Auth::user()->name; ?> </em> <i class="dropdown-icon fa fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu pull-right icon-right arrow">
												<li><a href="<?php echo url('users/edituser/'); ?>/<?php echo Auth::user()->_id; ?>" class='ajax-load'><i class="fa fa-user"></i> Profile</a></li>
												<li class="divider"></li>
												<li><a href="<?php echo url('/logout'); ?>"><i class="fa fa-sign-out"></i> Signout </a></li>
										</ul>
										<!-- //dropdown-menu-->
								</li>
								<li class="visible-lg">
									<a href="#" class="h-seperate fullscreen" data-toggle="tooltip" title="Full Screen" data-container="body"  data-placement="left">
										<i class="fa fa-expand"></i>
									</a>
								</li>
						</ul>
				</div>
				<!-- //tools-bar-->
				
		</div>
		<!-- //header-->
		
		
		<?php echo $__env->make('layouts.side-left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     TOP SEARCH CONTENT     ///////
		//////////////////////////////////////////////////////////////////////
		-->
		<div class="widget-top-search">
			<span class="icon"><a href="#" class="close-header-search"><i class="fa fa-times"></i></a></span>
			<form id="top-search">
					<h2><strong>Quick</strong> Search</h2>
					<div class="input-group">
							<input  type="text" name="q" placeholder="Find something..." class="form-control" />
							<span class="input-group-btn">
							<button class="btn" type="button" title="With Sound"><i class="fa fa-microphone"></i></button>
							<button class="btn" type="button" title="Visual Keyboard"><i class="fa fa-keyboard-o"></i></button>
							<button class="btn" type="button" title="Advance Search"><i class="fa fa-th"></i></button>
							</span>
					</div>
			</form>
		</div>
		<!-- //widget-top-search-->
		
		
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     MAIN SHOW CONTENT     //////////
		//////////////////////////////////////////////////////////////////////

		<div id="main" style="padding-top: 37px !important;">		-->
		<div id="main">
		</div>
		<!-- //main-->
		
		
		
		<!--
		///////////////////////////////////////////////////////////////////
		//////////     MODAL MESSAGES     //////////
		///////////////////////////////////////////////////////////////
		-->
		<div id="md-messages" class="modal fade md-slideUp bg-theme-inverse" data-width="450">
				<div class="modal-header bd-theme-inverse-darken">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title"><i class="fa fa-inbox"></i> Inbox messages</h4>
				</div>
				<!-- //modal-header-->
				<div class="modal-body" style="padding:0">
						<div class="widget-im">
						</div>
						<!-- //widget-im-->
				</div>
				
		</div>
		<!-- //modal-->
		
		
		<div id="md-normal" class="modal fade">
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title">Modals normal</h4>
				</div>
				<!-- //modal-header-->
				<div class="modal-body">
					<p>One fine body&hellip;</p>
				</div>
				<!-- //modal-body-->
				<!-- //modal-body-->
				<div class="modal-footer">
					
				</div>
		</div>
		
		
		<!--
		//////////////////////////////////////////////////////////////////////////
		//////////     MODAL NOTIFICATION     //////////
		//////////////////////////////////////////////////////////////////////
		-->
		<div id="md-notification" class="modal fade md-stickTop bg-danger" data-width="500">
				<div class="modal-header bd-danger-darken">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title"><i class="fa fa-bell-o"></i> Notification</h4>
				</div>
				<!-- //modal-header-->
				<div class="modal-body" style="padding:0">
						<div class="widget-im notification">
						
				
						</div>
						<!-- //widget-im-->
				</div>
				<!-- //modal-body-->
		</div>
		<!-- //modal-->
		
		<!--
		/////////////////////////////////////////////////////////////////////
		//////////     MODAL FULL WIDTH    //////////
		//////////////////////////////////////////////////////////////////
		-->
		<div id="md-full-width" class="modal fade container" style="margin-top: 0px !important;">
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title">Modals full width</h4>
				</div>
				<!-- //modal-header-->
				<div class="modal-body">
					<p>One fine body&hellip;</p>
				</div>
				<!-- //modal-body-->
		</div>
		<!-- //modal-->
		
	<?php echo $__env->make("layouts.left-nav", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make("layouts.right-nav", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		

<script type="text/javascript" src="<?php echo asset('public/assets/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="<?php echo asset('public/assets/js/modernizr/modernizr.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/mmenu/jquery.mmenu.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('public/assets/js/styleswitch.js'); ?>"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/form/form.js'); ?>"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/datetime/datetime.js'); ?>"></script>
<!-- Library Chart
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/chart/chart.js'); ?>"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/pluginsForBS/pluginsForBS.js'); ?>"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="<?php echo asset('public/assets/plugins/miscellaneous/miscellaneous.js'); ?>"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?php echo asset('public/assets/js/caplet.custom.js'); ?>"></script>

<script>
 $(document).ready(function() {
		$.ytLoad();
		$('#main').load('<?php echo url('/dashboard'); ?>');
});
 // function Auto close sub menu
		function closeSub(){
			var navMenu=$("nav#menu");
			if(navMenu.hasClass("mm-vertical")){
				navMenu.find("li").each(function(i) {
					$(this).removeClass("mm-opened");	
				});
			}else{
				navMenu.find("ul").each(function(i) {
					if(i==0){
						$(this).removeClass("mm-subopened , mm-hidden").addClass("mm-current");	
					}else{
						$(this).removeClass("mm-opened , mm-subopened , mm-current  , mm-highest").addClass("mm-hidden");						
					}	
				});
			}
		}
	
	function closeMenuLeft(){
		//alert('x');
		$("html").trigger("click");
	}

		
$(document).on("click","a.ajax-load",function(event) {
		$.ytLoad();
		//$("body").removeClass("nav-collapse-in");
		$('#main').html("");
		event.preventDefault();
		var hrefattr = $(this).attr("href");
		
		$('#main').load(hrefattr+'?d='+(new Date()).getTime(), function( response, status, xhr ) {
		  
		  if ( status == "error" || status == "404"  ) {
			var msg = JSON.parse(response);
			$.notific8(msg.error,{ life:7000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR "+xhr.status+" :( "});
			if(status == "error"){
				window.location.reload();
			}
		  }
				$('nav#menu').trigger( 'close.mm' );
		});
});

/*window.addEventListener('popstate', function(event) {
    // The popstate event is fired each time when the current history entry changes.

    var r = confirm("You pressed a Back button! Are you sure?!");

    if (r == true) {
        // Call Back button programmatically as per user confirmation.
        //history.back();
        // Uncomment below line to redirect to the previous page instead.
        // window.location = document.referrer // Note: IE11 is not supporting this.
    } else {
        // Stay on the current page.
        history.pushState(null, null, window.location.pathname);
    }

    //history.pushState(null, null, window.location.pathname);

}, false);
*/

$(document).on("click",".col-in",function(event){
	//$("body").addClass("nav-collapse-in");
})


</script>

<style>
.mm-menu .icon {
	font-size: 22px !important;
	width: 30px !important;
	height: 30px !important;
	text-align: center;
	margin: 0 10px 0 -6px;
}

.mm-list > li > a, .mm-list > li > span {
	padding: 8px 10px 8px 15px !important;
	display: inline-block;
	vertical-align: middle;
}
</body>
</html>

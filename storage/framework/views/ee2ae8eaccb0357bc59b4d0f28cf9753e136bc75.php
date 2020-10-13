<?
/*$userProfile = \App\Users::leftJoin("profiles","profiles.id","users.id_profile")
->select("profiles.name as profile_nama")
->where("users.id",Auth::user()->id)
->get()
->first();*/

$userProfile = \Modules\users\models\Users::where("_id",Auth::user()->_id)->get()->first();
?>	
	<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     SLIDE LEFT CONTENT     //////////
		//////////////////////////////////////////////////////////////////////
		-->
		<div id="nav">
				<div id="nav-scroll">
						<div class="avatar-slide">
						
								<span class="easy-chart avatar-chart" data-color="theme-inverse" data-percent="100" data-track-color="rgba(255,255,255,0.1)" data-line-width="5" data-size="118">
										<img alt="" src="<?php echo Gravatar::src(Auth::user()->email); ?>" class="circle">
								</span>
								<!-- //avatar-chart-->
								
								<div class="avatar-detail">
										<p style="text-transform:capitalize;"><strong>Hi</strong>, <?php echo e(Auth::user()->name); ?></p>
										<p><a href="#"><?php echo e(Auth::user()->email); ?></a></p>
										<span><?php echo e($userProfile->profiles->name); ?></span>
										<!--<span>106 Follower</span>-->
								</div>
								<!-- //avatar-detail-->
								<!--
								<div class="avatar-link btn-group btn-group-justified">
										<a class="btn" href="profile.html"  title="Portfolio"><i class="fa fa-briefcase"></i></a>
										<a class="btn"  data-toggle="modal" href="#md-notification" title="Notification">
												<i class="fa fa-bell-o"></i><em class="green"></em>
										</a>
										<a class="btn"  data-toggle="modal" href="#md-messages"  title="Messages">
												<i class="fa fa-envelope-o"></i><em class="active"></em>
										</a>
										<a class="btn" href="#menu-right" title="Contact List"><i class="fa fa-book"></i></a>
								</div>
								<!-- //avatar-link-->
								
						</div>
						<!-- //avatar-slide-->
						
						
						<!--<div class="widget-collapse dark">
								<header>
										<a data-toggle="collapse" href="#collapseSummary"><i class="collapse-caret fa fa-angle-up"></i> Summary Order </a>
								</header>
								<section class="collapse in" id="collapseSummary">
										<div class="collapse-boby" style="padding:0">
										
												<div class="widget-mini-chart align-xs-left">
														<div class="pull-right" >
																<div class="sparkline mini-chart" data-type="bar" data-color="warning" data-bar-width="10" data-height="35">2,3,4,5,7,4,5</div>
														</div>
														<p>This week's balance</p>
														<h4>$12,788</h4>
												</div>
												
												<div class="widget-mini-chart align-xs-right">
														<div class="pull-left">
																<div class="sparkline mini-chart" data-type="bar" data-color="theme" data-bar-width="10" data-height="45">2,3,7,5,4,6,6,3</div>
														</div>
														<p>This week sales</p>
														<h4>1,325 item</h4>
												</div>
												
										</div>
										
								</section>
						</div>
						<!-- //widget-collapse-->
						
						
						
						<!--<div class="widget-collapse dark">
								<header>
										<a data-toggle="collapse" href="#collapseTasks"><i class="collapse-caret fa fa-angle-down"></i> (2) Tasks processing </a>
								</header>
								<section class="collapse" id="collapseTasks">
								
										<div class="collapse-boby">
										
												<div class="widget-slider">
														<p>Upload status</p>
														<div class="progress progress-dark progress-xs tooltip-in">
																<div class="progress-bar bg-darkorange" aria-valuetransitiongoal="75"></div>
														</div>
														<label class="progress-label">Master.zip 4 / 5 </label>
														
														<div class="progress progress-dark progress-xs">
																<div class="progress-bar bg-theme-inverse" aria-valuetransitiongoal="45"></div>
														</div>
														<label class="progress-label lasted">Profile 2 / 5 </label>
														
												</div>
												
										</div>
										
								</section>
								
						</div>
						
						<div class="widget-collapse dark">
								<header>
										<a data-toggle="collapse" href="#collapseSetting"><i class="collapse-caret fa fa-angle-up"></i> Setting Option </a>
								</header>
								<section class="collapse in" id="collapseSetting">
										<div class="collapse-boby" style="padding:0">
										
												<ul class="widget-slide-setting">
														<li>
																<div class="ios-switch theme pull-right">
																		<div class="switch"><input type="checkbox" name="option"></div>
																</div>
																<label>Switch <span>OFF</span></label>
																<small>Lorem ipsum dolor sit amet</small>
														</li>
														<li>
																<div class="ios-switch theme-inverse pull-right">
																		<div class="switch"><input type="checkbox" name="option_1" checked></div>
																</div>
																<label>Switch <span>ON</span></label>
																<small>Lorem ipsum dolor sit amet</small>
														</li>
												</ul>
												
										</div>
										
								</section>
								
						</div>
						
						-->
				</div>
				<!-- //nav-scroller-->
		</div>
		<!-- //nav-->
		
		
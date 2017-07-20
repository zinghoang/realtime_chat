<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chat Blue Team</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/messsages.css') }}" rel="stylesheet">
	<link href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
	<div class="container-fluid ng-scope">
		<div class="block-header">
			<h2> </h2> 
		</div>
		<div class="card m-b-0" id="messages-main" style="box-shadow:0 0 40px 1px #c9cccd;">
			<div class="ms-menu" style="overflow:scroll; overflow-x: hidden;" id="ms-scrollbar">
				<div class="ms-block">
					<div class="ms-user"> 
						<img src="{{ asset('images/avatar.jpg') }}" alt="">
						<h5 class="q-title" align="center">Sachin Yadav <br/><b>5</b> New Messages</h5> 
					</div>
				</div>
				<div class="ms-block"> 
					<a class="btn btn-primary btn-block ms-new" href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp; New Message</a> 
				</div>
				<hr/>
				<div class="listview lv-user m-t-20">
					<div class="lv-item media active">
						<div class="lv-avatar pull-left"> 
							<img src="{{ asset('images/bhai.jpg') }}" alt=""> 
						</div>
						<div class="media-body">
							<div class="lv-title">Ashwani Singh Yadav</div>
							<div class="lv-small"> Acadnote a world class website is processing surveys for </div>
						</div>
					</div>
					<div class="lv-item media"> 
						<div class="lv-avatar pull-left"> 
							<img src="{{ asset('images/chota.jpg') }}" alt=""> 
						</div>
						<div class="media-body"> 
							<div class="lv-title">
								<b>Deepak Yadav</b>
								<span class="pull-right">2 new</span>
							</div>
							<div class="lv-small">
								<b>aur bhai collage kse chale rhai hai </b>
							</div>
						</div>
					</div>
					<div class="lv-item media">
						<div class="lv-avatar pull-left"> <img src="{{ asset('images/sumit.jpg') }}" alt=""> </div>
						<div class="media-body">
							<div class="lv-title">Sumit kumar</div>
							<div class="lv-small">aur suna kya haal hai bhai, aur</div>
						</div>
					</div>
					<div class="lv-item media">
						<div class="lv-avatar pull-left"> <img src="{{ asset('images/sumit.jpg') }}" alt=""> </div>
						<div class="media-body">
							<div class="lv-title">Sumit kumar</div>
							<div class="lv-small">aur suna kya haal hai bhai, aur</div>
						</div>
					</div>
					<div class="lv-item media">
						<div class="lv-avatar pull-left"> <img src="{{ asset('images/sumit.jpg') }}" alt=""> </div>
						<div class="media-body">
							<div class="lv-title">Sumit kumar</div>
							<div class="lv-small">aur suna kya haal hai bhai, aur</div>
						</div>
					</div>
					<div class="lv-item media">
						<div class="lv-avatar pull-left"> <img src="{{ asset('images/sumit.jpg') }}" alt=""> </div>
						<div class="media-body">
							<div class="lv-title">Sumit kumar</div>
							<div class="lv-small">aur suna kya haal hai bhai, aur</div>
						</div>
					</div>
					<div class="lv-item media">
						<div class="lv-avatar pull-left"> <img src="{{ asset('images/sumit.jpg') }}" alt=""> </div>
						<div class="media-body">
							<div class="lv-title">Sumit kumar</div>
							<div class="lv-small">aur suna kya haal hai bhai, aur</div>
						</div>
					</div>
					<div class="lv-item media">
						<div class="lv-avatar pull-left"> <img src="{{ asset('images/sumit.jpg') }}" alt=""> </div>
						<div class="media-body">
							<div class="lv-title">Sumit kumar</div>
							<div class="lv-small">aur suna kya haal hai bhai, aur</div>
						</div>
					</div>
					<div class="lv-item media">
						<div class="lv-avatar pull-left"> <img src="{{ asset('images/sumit.jpg') }}" alt=""> </div>
						<div class="media-body">
							<div class="lv-title">Sumit kumar</div>
							<div class="lv-small">aur suna kya haal hai bhai, aur</div>
						</div>
					</div>
					<div class="lv-item media">
						<div class="lv-avatar pull-left"> <img src="{{ asset('images/sumit.jpg') }}" alt=""> </div>
						<div class="media-body">
							<div class="lv-title">Sumit kumar</div>
							<div class="lv-small">aur suna kya haal hai bhai, aur</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ms-body">
				<div class="listview lv-message">
					<div class="lv-header-alt clearfix">
						<div id="ms-menu-trigger">
							<div class="line-wrap">
								<div class="line top"></div>
								<div class="line center"></div>
								<div class="line bottom"></div>
							</div>
						</div>
						<div class="lvh-label hidden-xs">
							<div class="lv-avatar pull-left"> <img src="{{ asset('images/bhai.jpg') }}" alt=""> </div><span class="c-black">Ashwani Singh Yadav<span class="nick-online"></span></span>
						</div>
						<ul class="lv-actions actions list-unstyled list-inline">
							<li>
								<a href="#"> <i class="fa fa-check"></i> </a>
							</li>
							<li>
								<a href="#"> <i class="fa fa-clock-o"></i> </a>
							</li>
							<li>
								<a data-toggle="dropdown" href="#"> <i class="fa fa-list"></i>
								</a>
								<ul class="dropdown-menu user-detail" role="menu">
									<li> <a href="">Latest</a> </li>
									<li> <a href="">Oldest</a> </li>
								</ul>
							</li>
							<li> <a data-toggle="dropdown" href="#" data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span class="glyphicon glyphicon-trash"></span></a>
								<ul class="dropdown-menu user-detail" role="menu">
									<li> <a href="">Delete Messages</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="lv-body">
						<div class="row content-chat-video">
							<div class="col-md-7">
							
								<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:580px;">
									<div class="content-video">
										<iframe width="100%" height="315" src="https://www.youtube.com/embed/mji0VwdFjJI" frameborder="0" allowfullscreen></iframe>
										<h3>Eum doloremque sunt dolore et velit</h3>
										<hr>
									</div>
									<div class="list-video">

										<ul class="show-list-video" style="list-style: none;">
											<li class="active">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;It's gives the power to synthesis anything...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-volume-up" aria-hidden="true"></i> &nbsp;We are sharing this knowledge in all ...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-volume-up" aria-hidden="true"></i> &nbsp;Its the ultimate tool to solve any problem....
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;We help you excel in that by working with you.
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
											<li class="">
												<a href="">
													<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
												</a>
											</li>
										</ul>
									</div>
									
									
								</div>
							</div>
							<div class="col-md-5 div-chat">
								<div id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:580px;">
									<div class="lv-item media right">
										<div class="lv-avatar pull-right"> 
											<img src="{{ asset('images/avatar.jpg') }}" alt=""> 
										</div>
										<div class="media-body">
											<div class="ms-item"> 
												We started this site with clear mission that we want to deliver complete details knowledge of Programming to our audience. We are sharing this knowledge in all areas that you can see in our site. 
											</div>
											<small class="ms-date">
												<span class="glyphicon glyphicon-time"></span>
												&nbsp; 05/10/2015 at 09:30
											</small> 
										</div>
									</div>
									<div class="lv-item media">
										<div class="lv-avatar pull-left"> 
											<img src="{{ asset('images/bhai.jpg') }}" alt=""> 
										</div>
										<div class="media-body">
											<div class="ms-item"> 
												It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
											</div>
											<small class="ms-date">
												<span class="glyphicon glyphicon-time"></span>
												&nbsp; 20/02/2015 at 09:33
											</small> 
										</div>
									</div>
									<div class="lv-item media">
										<div class="lv-avatar pull-left"> 
											<img src="{{ asset('images/bhai.jpg') }}" alt=""> 
										</div>
										<div class="media-body">
											<div class="ms-item"> 
												It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
											</div>
											<small class="ms-date">
												<span class="glyphicon glyphicon-time"></span>
												&nbsp; 20/02/2015 at 09:33
											</small> 
										</div>
									</div>
									<div class="lv-item media">
										<div class="lv-avatar pull-left"> 
											<img src="{{ asset('images/bhai.jpg') }}" alt=""> 
										</div>
										<div class="media-body">
											<div class="ms-item"> 
												It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
											</div>
											<small class="ms-date">
												<span class="glyphicon glyphicon-time"></span>
												&nbsp; 20/02/2015 at 09:33
											</small> 
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="lv-footer ms-reply">
									<textarea rows="10" placeholder="Write messages..."></textarea>
									<button class="">
										<span class="glyphicon glyphicon-send"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
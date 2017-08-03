<!-- Menu nav -->

<nav class="">
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	<div class="navbar-nav">
	<ul style="list-style: none;">
		<li>
			<!-- <div class="ms-block"> -->
				<div class="ms-user"> 
					<div class="dropdown">
						<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown-name" >
							{{ str_limit(Auth::user()->fullname, 10) }}
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li>
								<a href="{{ route('account.edit', Auth::id()) }}">Edit profile <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="{!! url('/logout') !!}" 
					                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none;">
					                Sign out <i class="fa fa-sign-out" aria-hidden="true"></i>
					            </a>
					            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
					                {{ csrf_field() }}
					            </form>
							</li>
						</ul>
					</div>   
				</div>
			<!-- </div> -->
		</li>
		<li>
				<form action="{{ route('SearchUserRoom') }}" method="get">
					<div class="form-group">
						<input type="text" name="search" class="form-control" id="name" placeholder="Search" value="">
					</div>
				</form>
		</li>
		<li>
			<a href="{{ route('frontend.private.request') }}" title="Friend Request" style="text-decoration:none;">
				Friend Request
			</a>
			/
			<a href="{{ route('frontend.private.friend') }}" title="Your Friends" style="text-decoration:none;">
				Your Friends
			</a>
		</li>
		<li>
			<a href="{{ route('frontend.room.index') }}" title="" style="text-decoration:none;">
				Show More Rooms...
			</a>
		</li>
		<li>
			<a href="{{ route('frontend.private.index') }}" title="" style="text-decoration:none;">
				Show More Contacts...
			</a>
		</li>
	</ul>
	
	</div>
	</div>
</nav>
<div class="ms-menu" style="overflow:scroll; overflow-x: hidden;" id="ms-scrollbar">
	<div class="ms-block">
		<div class="ms-user"> 
			<img src="{{ url('storage/avatars/' . Auth::user()->avatar ) }}" alt="">
			<h5 class="q-title" align="center">
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
			</h5> 
		</div>
	</div>
	<div class="ms-block"> 
		<form action="{{ route('SearchUserRoom') }}" method="get">
			<div class="form-group">
				<input type="text" name="search" class="form-control" id="name" placeholder="Search" value="{{ old('search') }}">
			</div>
		</form>
	</div>
	<hr/>
	<div class="listview lv-user m-t-20">
		<div class="lv-item media {{ Request::is('friend-request') ? 'active' : '' }}">
		<div class="media-body">
			<p class="text-center" style="margin: 0px;">
				<a href="{{ route('frontend.private.request') }}" title="" style="text-decoration:none;">
					View List Friend Request
				</a>
			</p>
		</div>
	</div>
	<hr/>
	</div>
	<div class="listview lv-user m-t-20 listRoom">
		@widget('listRoomChat')
	</div>
	<hr>
	<div class="listview lv-user m-t-20 listUser">
		@widget('listUserChat')
	</div>
</div>

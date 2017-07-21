<div class="ms-menu" style="overflow:scroll; overflow-x: hidden;" id="ms-scrollbar">
	<div class="ms-block">
		<div class="ms-user"> 
			<img src="{{ url('storage/avatars/' . Auth::user()->avatar ) }}" alt="">
			<h5 class="q-title" align="center">
				<a href="{{ route('account.edit', Auth::id()) }}">{{ Auth::user()->fullname }} <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				<br />                                    
            <a href="{!! url('/logout') !!}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none;">
                Sign out <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
				</h5> 
		</div>
	</div>
	<div class="ms-block"> 
		<form action="{{ route('SearchUser') }}" method="get">
			<div class="form-group">
				<input type="text" name="search" class="form-control" id="name" placeholder="Search" value="{{ old('search') }}">
				<div class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
			</div>
		</form>
	</div>
	<hr/>
	<div class="listview lv-user m-t-20">
		@widget('listRoomChat')
	</div>
	<hr>
	<div class="listview lv-user m-t-20">
		@widget('listUserChat')
	</div>
</div>

@foreach($listUser as $user)
<div class="lv-item media {{ Request::is('chat/' . $user->name) ? 'active' : '' }}">
	<a href="{{ route('private.user', $user->name) }}" title="" style="text-decoration:none;">
	<div class="lv-avatar pull-left"> <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt=""> </div>
	<div class="media-body">
		<div class="lv-title">{{ $user->fullname }}</div>
		<div class="lv-small">@ {{ $user->name }}</div>
	</div>
	</a>
</div>
@endforeach
<div class="lv-item media {{ Request::is('chat') ? 'active' : '' }}">
	<div class="media-body">
		<p class="text-center" style="margin: 0px;">
			<a href="{{ route('frontend.private.index') }}" title="" style="text-decoration:none;">
				SHOW MORE...
			</a>
		</p>
	</div>
</div>
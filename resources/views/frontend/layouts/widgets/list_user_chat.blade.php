@if($listUser->count() > 0)
	@foreach($listUser as $user)
	<div class="lv-item media {{ Request::is('chat/' . $user->name) ? 'active' : '' }}">
		<div class="lv-avatar pull-left">
				<img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="">
		</div>
		<div class="media-body">
			<div class="lv-title">
				<a href="{{ route('private.user', $user->name) }}" title="" style="text-decoration:none;">
				{{ $user->fullname }}
				</a>
				@if($user->notif == 1)
					<i class="fa fa-star" aria-hidden="true" style="color: #aa1111"></i>
				@endif
			</div>
			<div class="lv-small">@ {{ $user->name }}</div>
		</div>
	</div>
	@endforeach
	<div class="lv-item media {{ Request::is('chat') ? 'active' : '' }}">
		<div class="media-body">
			<p class="text-center" style="margin: 0px;">
				<a href="{{ route('frontend.private.index') }}" title="" style="text-decoration:none;">
					Show All Contacts
				</a>
			</p>
		</div>
	</div>
@else
	<div class="lv-item media active text-center">
		<div class="media-body">
			<p class="text-center" style="margin: 0px;">
				<span style="text-decoration:none; font-family: Arial, Verdana, sans-serif; color: #1b6d85">
					No Recent Contact
				</span>
			</p>
		</div>
	</div>
@endif

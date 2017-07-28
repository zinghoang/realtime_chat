@foreach($listRoom as $room)
<div class="lv-item media {{ Request::is('message/room/' . $room->id) ? 'active' : '' }}">
		<div class="lv-avatar pull-left">
			<img src="{{ asset('images/home.png') }}" alt="">
		</div>
		<div class="media-body">
			<div class="lv-title">
				<a href="{{ route('frontend.message.room', $room->id) }}" title="" style="text-decoration:none;">
				{{ $room->name }}
				</a>
				@if($room->notif == 1)
					<i class="fa fa-star" aria-hidden="true" style="color: #aa1111"></i>
				@endif
			</div>
			<div class="lv-small"> Click here to chat... </div>
		</div>
</div>
@endforeach
<div class="lv-item media {{ Request::is('room') ? 'active' : '' }}">
	<div class="media-body">
		<p class="text-center" style="margin: 0px;">
			<a href="{{ route('frontend.room.index') }}" title="" style="text-decoration:none;">
				SHOW ALL ROOMS
			</a>
		</p>
	</div>
</div>
<script>
	var listRoom = {!!json_encode($listRoom) !!}
	var roomJoined = {!!json_encode($roomJoined)!!}
</script>
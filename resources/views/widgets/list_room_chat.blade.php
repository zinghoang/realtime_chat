@foreach($listRoom as $room)
<div class="lv-item media">
	<a href="{{ route('frontend.message.room', $room->id) }}" title="" style="text-decoration:none;">
		<div class="lv-avatar pull-left"> 
			<img src="{{ asset('images/home.png') }}" alt=""> 
		</div>
		<div class="media-body">
			<div class="lv-title">{{ $room->name }}</div>
			<div class="lv-small"> Click here to chat... </div>
		</div>
	</a>
</div>
@endforeach
@extends('frontend.layouts.master')

@section('content')

<div class="ms-body">
	<div class="listview lv-message">
		@widget('MessageRoom', ['id' => $room->id], $room->id)
		<div class="lv-body">
			<div class="row content-chat-video">
				<div class="col-md-12">
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:530px;">
						<div class="col-md-12">
							<h5 class="text-center">
								All the member of this room...
								<a href="{{ route('frontend.message.room', $room->id) }}">Back</a>
							</h5>
							<hr>
						</div>
						
						@foreach($listMemberOrRoom as $key => $member)
							<div class="col-md-4 col-md-offset-2">
								<div class="lv-item media ">
									<a href="{{ route('private.user', $member->user->name) }}" title="" style="text-decoration:none;">
									<div class="lv-avatar pull-left"> <img src="{{ asset('storage/avatars/' . $member->user->avatar) }}" alt=""> </div>
									<div class="media-body">
										<div class="lv-title">{{ $member->user->fullname }} {!! ($room->user_id == $member->user->id)?'<span style="color:red">[AD]</span>':'' !!}</div>
										<div class="lv-small">
											@ {{ $member->user->name }}

											@if($room->user_id == Auth::id())
												<a href="{{ route('frontend.room.ban', ['user' => $member->user->id, 'room' => $room->id]) }}" class="delete-member">
													<i class="fa fa-times-circle" aria-hidden="true"></i>
												</a>
											@endif
										</div>
									</div>
									</a>
								</div>
							</div>	
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
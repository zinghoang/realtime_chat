@extends('frontend.layouts.master')

@section('content')

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
				<div class="lv-avatar pull-left"> 
					<span style="color: #818181;"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
				</div>
				<span class="c-black">Chat</span>
			</div>
		</div>
		<div class="lv-body">
			<div class="row content-chat-video">
				<div class="col-md-12">
				
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:530px;">
						@if(1 == 0)
						<div class="row">
							<div class="col-md-12">
			                    <div class="border text-center">
			                        <span style="font-size: 360px; color: #cccccc;">
			                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
			                        </span>
			                    </div>
			                </div>
						</div>
						@else
						<div class="row">
							<div class="col-md-12">
								<h5 class="text-center">USER RESULT OF "{{ $nameSeach }}"</h5>
								<hr>
							</div>
							@if($users->count()>0)
                        		@foreach($users as $key => $user)
									<div class="col-md-4 col-md-offset-2">
										<div class="lv-item media ">
											<a href="{{ route('private.user',$user->name) }}" title="" style="text-decoration:none;">
											<div class="lv-avatar pull-left"> <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt=""> </div>
											<div class="media-body">
												<div class="lv-title">{{ $user->fullname }}</div>
												<div class="lv-small">@ {{ $user->name }}</div>
											</div>
											</a>
										</div>
									</div>	
								@endforeach
		                    @else
								<div class="col-md-8 col-md-offset-2">
									<h3	 class="text-center">
										<span style="color: #761c19">NO DATA TO SHOW</span>
									</h3>
								</div>
		                    @endif
						</div>
						@endif
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="lv-body">
			<div class="row content-chat-video">
				<div class="col-md-12">
				
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:530px;">
						@if(1 == 0)
						<div class="row">
							<div class="col-md-12">
			                    <div class="border text-center">
			                        <span style="font-size: 360px; color: #cccccc;">
			                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
			                        </span>
			                    </div>
			                </div>
						</div>
						@else
						<div class="row">
							<div class="col-md-12">
								<h5 class="text-center">ROOM RESULT OF "{{ $nameSeach }}"</h5>
								<hr>
							</div>
							@if($rooms->count()>0)
                        		@foreach($rooms as $key => $room)
									<div class="col-md-4 col-md-offset-2">
										<div class="lv-item media ">
											<div class="lv-avatar pull-left"></div>
											<div class="media-body">
												<div class="lv-small">@ {{ $room->name }}</div>
											</div>
											</a>
										</div>
									</div>	
								@endforeach
		                    @else
								<div class="col-md-8 col-md-offset-2">
									<h3	 class="text-center">
										<span style="color: #761c19">NO DATA TO SHOW</span>
									</h3>
								</div>
		                    @endif
						</div>
						@endif
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		
	</div>
</div>
@stop
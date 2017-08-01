@extends('frontend.layouts.master')

@section('content')

<div class="ms-body"> 
	<div class="listview lv-message">
		<div class="lv-header-alt clearfix">
			<div id="ms-menu-trigger">
				<div class="line-wrap button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" role="button" type="button">
                    <div class="line top"></div>
                    <div class="line center"></div>
                    <div class="line bottom"></div>
                </div>
                @widget('MenuNav')
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
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:80vh;">
						@if(count($users) == 0 )
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
									<h5 class="text-center">Some recent contact</h5>
									<hr>
								</div>
								@if(count($users) > 0)
									@foreach($users as $user)
										<div class="col-md-4 col-md-offset-2">
											<div class="lv-item media ">
												@if($user->friendship == null)
													<a href="{{ route('requestRelationship',$user->id) }}" title="Add friend" style="text-decoration:none;">
														<i class="fa fa-plus" aria-hidden="true"></i>
													</a>
												@else
													@if($user->friendship->user_request == Auth::user()->id)
														@if($user->friendship->status == 0)
															<a href="{{ route('deleteRelationship',$user->friendship->id) }}" title="Calcel Request" style="text-decoration:none;">
																<i class="fa fa-ban" aria-hidden="true"></i>
															</a>
														@else
															Friend
														@endif
													@elseif($user->friendship->user_request == $user->id)
														@if($user->friendship->status == 0)
															<a href="{{ route('acceptRelationship',$user->friendship->id) }}" title="Accept" style="text-decoration:none;">
																<i class="fa fa-check" aria-hidden="true"></i>
															</a>
															<a href="{{ route('deleteRelationship',$user->friendship->id) }}" title="Deny" style="text-decoration:none;">
																<i class="fa fa-ban" aria-hidden="true"></i>
															</a>
														@else
															Friend
														@endif
													@endif
												@endif
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
	</div>
</div>
@stop
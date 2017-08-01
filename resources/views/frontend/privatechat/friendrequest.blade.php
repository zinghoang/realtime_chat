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
                <span class="c-black">Friend Request</span>
            </div>
        </div>
        <div class="lv-body">
            <div class="row content-chat-video">
                <div class="col-md-12">
                    <div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:80vh;">
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-center">Some friend request</h5>
                                    <hr>
                                </div>
                                @if(count($friendRequests) > 0)
                                    @foreach($friendRequests as $user)
                                        <div class="col-md-4 col-md-offset-2">
                                            <div class="lv-item media ">                                             

                                                <a href="{{ route('acceptRelationship',$user->fid) }}" title="Accept" style="text-decoration:none;">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('deleteRelationship',$user->fid) }}" title="Deny" style="text-decoration:none;">
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                </a>
                                                
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
                                        <h3  class="text-center">
                                            <span style="color: #761c19">NO DATA TO SHOW</span>
                                        </h3>
                                    </div>
                                @endif
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-center">Some friend wait accept</h5>
                                    <hr>
                                </div>
                                @if(count($friendWaitAccept) > 0)
                                    @foreach($friendWaitAccept as $user)
                                        <div class="col-md-4 col-md-offset-2">
                                            <div class="lv-item media ">

                                                <a href="{{ route('deleteRelationship',$user->fid) }}" title="Deny" style="text-decoration:none;">
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                </a>                                                    
                                                
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
                                        <h3  class="text-center">
                                            <span style="color: #761c19">NO DATA TO SHOW</span>
                                        </h3>
                                    </div>
                                @endif
                            </div>
                        
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@stop
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
                    <img src="{{ asset('storage/avatars/' . $toUser->avatar) }}" alt=""> 
                </div>
                <span class="c-black">{{ $toUser->fullname }}<span class="nick-online"></span></span>
            </div>
            <ul class="lv-actions actions list-unstyled list-inline">
                @if($friendship != null)
                @if($friendship->status == 1)
                <li>
                    <a href="{{ route('deleteRelationship',$friendship->id) }}"> <i class="fa fa-ban"></i></a> Unfriend
                </li>
                @endif
                @if($friendship->status == 0 && $friendship->user_request == Auth::user()->id)
                    <li>
                        <a href="{{ route('requestRelationship',$toUser->id) }}">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </a>
                    </li>
                @elseif($friendship->status == 0 && $friendship->user_accept == Auth::user()->id)
                    <li>
                        <a href="{{ route('acceptRelationship',$friendship->id) }}">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('deleteRelationship',$friendship->id) }}">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </a>
                    </li>
                @endif
                @else
                    <li>
                        <a href="{{ route('requestRelationship',$toUser->id) }}">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="lv-body">
            <div class="row content-chat-video">
                <div class="col-md-12">
                    <div id="ms-scrollbar" class="content-message" style="overflow:scroll; overflow-x: hidden; height:480px;">
                        @foreach ($listPrivateChat as $key => $chat)
                        <div class="lv-item media @if($chat->from == Auth::id()) right @endif">
                            <div class="lv-avatar @if($chat->from == Auth::id()) pull-right @else pull-left @endif">
                                @if($chat->from == $user->id)
                                    <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="">
                                @elseif($chat->from == $toUser->id)
                                    <img src="{{ asset('storage/avatars/'.$toUser->avatar) }}" alt="">
                                @endif

                            </div>
                            <div class="media-body">
                                <div class="ms-item"> 
                                    {!! $chat->content !!}
                                </div>
                                <small class="ms-date">
                                    <span class="glyphicon glyphicon-time"></span>
                                    &nbsp; {{ date('d-m-Y', strtotime($chat->created_at)) }} at {{ date('h:i:s', strtotime($chat->created_at)) }}
                                </small> 
                            </div>
                        </div>
                        @endforeach
                        </div>
                        <div class="clearfix"></div>
                        <div class="lv-footer ms-reply">
                            <textarea rows="10" placeholder="Write messages..." id="txt-mess-content"></textarea>
                            <button class="" id='btn-reply'>
                                <span class="glyphicon glyphicon-send"></span>
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    var toUser = {!!json_encode($toUser)!!};
    console.log(toUser);

    $('#txt-mess-content').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == 13) {
            $('#btn-reply').click();
            $('#content-message').val('');
        }
    });
</script>

@endsection

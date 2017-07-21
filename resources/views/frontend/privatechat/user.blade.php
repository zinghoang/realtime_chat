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
                <li>
                    <a href="#"> <i class="fa fa-check"></i> </a>
                </li>
                <li>
                    <a href="#"> <i class="fa fa-clock-o"></i> </a>
                </li>
                <li>
                    <a data-toggle="dropdown" href="#"> <i class="fa fa-list"></i>
                    </a>
                    <ul class="dropdown-menu user-detail" role="menu">
                        <li> <a href="">Latest</a> </li>
                        <li> <a href="">Oldest</a> </li>
                    </ul>
                </li>
                <li> <a data-toggle="dropdown" href="#" data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span class="glyphicon glyphicon-trash"></span></a>
                    <ul class="dropdown-menu user-detail" role="menu">
                        <li> <a href="">Delete Messages</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="lv-body">
            <div class="row content-chat-video">
                <div class="col-md-12">
                    <div id="ms-scrollbar" class="content-message" style="overflow:scroll; overflow-x: hidden; height:530px;">
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
</script>
<script src="{{ asset('js/chat.js') }}"></script>

@endsection

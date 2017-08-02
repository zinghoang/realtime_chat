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
                @if(Session::has('fail'))
                    <p><span style="font-size: 30px;color: #aa1111;margin-right: 20px"><i class="fa fa-ban" aria-hidden="true"></i></span><strong style="color: #aa1111">{{ Session::get('fail') }}</strong><span style="font-size: 30px;color: #aa1111;margin-left: 20px"><i class="fa fa-ban" aria-hidden="true"></i></span></p>
                @endif
                <span class="c-black">
                    Welcome to Chat Blue Team!
                </span>
            </div>
        </div>
        <div class="lv-body list-message-room" id="list-message-room" style="overflow:scroll; overflow-x: hidden; height:520px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="border text-center">
                        <span style="font-size: 360px; color: #cccccc;">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="lv-footer ms-reply">

        </div>
    </div>
</div>
@stop
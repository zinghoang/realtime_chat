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

                <span class="c-black">
                    Welcome to Chat Blue Team!
                </span>
            </div>
        </div>
        <div class="lv-body list-message-room" id="list-message-room" style="overflow:scroll; overflow-x: hidden; height:520px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="border text-center">
                        <a class="" href="javascript:void(0)" style="font-size: 360px;">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
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
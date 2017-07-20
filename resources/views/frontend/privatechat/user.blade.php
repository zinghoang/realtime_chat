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
                <div class="lv-avatar pull-left"> <img src="{{ asset('images/bhai.jpg') }}" alt=""> </div><span class="c-black">Ashwani Singh Yadav<span class="nick-online"></span></span>
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
                    <div id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:530px;">
                        <div class="lv-item media right">
                            <div class="lv-avatar pull-right"> 
                                <img src="{{ asset('images/avatar.jpg') }}" alt=""> 
                            </div>
                            <div class="media-body">
                                <div class="ms-item"> 
                                    We started this site with clear mission that we want to deliver complete details knowledge of Programming to our audience. We are sharing this knowledge in all areas that you can see in our site. 
                                </div>
                                <small class="ms-date">
                                    <span class="glyphicon glyphicon-time"></span>
                                    &nbsp; 05/10/2015 at 09:30
                                </small> 
                            </div>
                        </div>
                        <div class="lv-item media">
                            <div class="lv-avatar pull-left"> 
                                <img src="{{ asset('images/bhai.jpg') }}" alt=""> 
                            </div>
                            <div class="media-body">
                                <div class="ms-item"> 
                                    It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
                                </div>
                                <small class="ms-date">
                                    <span class="glyphicon glyphicon-time"></span>
                                    &nbsp; 20/02/2015 at 09:33
                                </small> 
                            </div>
                        </div>
                        <div class="lv-item media">
                            <div class="lv-avatar pull-left"> 
                                <img src="{{ asset('images/bhai.jpg') }}" alt=""> 
                            </div>
                            <div class="media-body">
                                <div class="ms-item"> 
                                    It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
                                </div>
                                <small class="ms-date">
                                    <span class="glyphicon glyphicon-time"></span>
                                    &nbsp; 20/02/2015 at 09:33
                                </small> 
                            </div>
                        </div>
                        <div class="lv-item media">
                            <div class="lv-avatar pull-left"> 
                                <img src="{{ asset('images/bhai.jpg') }}" alt=""> 
                            </div>
                            <div class="media-body">
                                <div class="ms-item"> 
                                    It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
                                </div>
                                <small class="ms-date">
                                    <span class="glyphicon glyphicon-time"></span>
                                    &nbsp; 20/02/2015 at 09:33
                                </small> 
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="lv-footer ms-reply">
                        <textarea rows="10" placeholder="Write messages..."></textarea>
                        <button class="">
                            <span class="glyphicon glyphicon-send"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
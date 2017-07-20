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
				<div class="lv-avatar pull-left"> <img src="{{ asset('images/home.png') }}" alt=""> </div><span class="c-black">All rooms</span>
			</div>
		</div>
		<div class="lv-body">
			<div class="row content-chat-video">
				<div class="col-md-7">
				
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:550px;">
					</div>
				</div>
				<div class="col-md-5 div-chat">
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
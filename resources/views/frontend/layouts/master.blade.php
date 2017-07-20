@include('frontend.layouts.header')
	<div class="container-fluid ng-scope">
		<div class="block-header">
			<h2> </h2> 
		</div>
		<div class="card m-b-0" id="messages-main" style="box-shadow:0 0 40px 1px #c9cccd;">
			@include('frontend.layouts.leftbar')
			@yield('content')
		</div>
	</div>
@include('frontend.layouts.footer')
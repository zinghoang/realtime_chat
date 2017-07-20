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
                <div class="lvh-label hidden-xs" style="width: 100%">
                @if(Session::has('success'))
                    <div class="alert alert-success"><p><strong>{{ Session::get('success') }}</strong></p></div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                @endif
                <H3><span class="c-black">YOUR PROFILE</span></H3>
                </div>
            </div>

            <div class="lv-body list-message-room" id="list-message-room" style="overflow:scroll; overflow-x: hidden; height:520px;">
                <div class="clearfix"></div>
                <form method="POST" action="{{ route('account.update',Auth::user()->id) }}" accept-charset="UTF-8" id="user_update" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <!-- Name Field -->
                        <div class="col-sm-6">
                            <label for="name">Name:</label>
                            <input class="form-control" name="name" type="text" id="name" value="{{ Auth::user()->name }}">
                        </div>
                        <!-- Email Field -->
                        <div class="col-sm-6">
                            <label for="email">Email:</label>
                            <input class="form-control" name="email" type="email" id="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <!-- Password Field -->
                        <div class="col-sm-6">
                            <label for="password">Password:</label>
                            <input class="form-control" name="password" type="password" id="password" value="">
                        </div>
                        <!-- Fullname Field -->
                        <div class="col-sm-6">
                            <label for="fullname">Fullname:</label>
                            <input class="form-control" name="fullname" type="text" id="fullname" value="{{ Auth::user()->fullname }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <!-- Avatar Field -->
                        <div class="col-sm-6">
                            <label for="avatar">Avatar:</label>
                            <input class="form-control" name="avatar" type="file" id="avatar" onchange="viewImg(this)">
                            <br>
                            <p><img id="avartar-img-show" src="{{ url("storage/avatars/".Auth::user()->avatar) }}" alt="avatar" class="img-responsive" width="200px" height="200px"></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <!-- Submit Field -->
                        <div class="col-sm-12">
                            <input class="btn btn-primary" type="submit" value="Save">
                            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <div class="lv-footer ms-reply">

            </div>
        </div>
    </div>
@stop
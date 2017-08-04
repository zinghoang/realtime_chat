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
                <div class="lvh-label hidden-xs" style="width: 100%">
                
                <h3><span class="c-black">YOUR PROFILE</span></h3>
                <div id="notes"></div>
                </div>
            </div>


            <div class="lv-body list-message-room" id="list-message-room" style="overflow:scroll; overflow-x: hidden; height:76vh;">
                <div class="clearfix"></div>
                <div class="row" style="margin: 5px 0px;">
                    <div class="col-md-12">

                    @if($errors->count()>0)
                        <ul class="alert alert-danger" style="list-style-type: none">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('account.update',Auth::user()->id) }}" accept-charset="UTF-8" id="user_update" enctype="multipart/form-data" style="margin: 5px 0px;">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <!-- Name Field -->
                        <div class="col-sm-6">
                            <label for="name">Name:</label>
                            <input class="form-control" name="name" type="text" id="name" value="{{ Auth::user()->name }}" readonly>
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
                        <!-- Password Field -->
                        <div class="col-sm-6">
                            <label for="password_confirmation">Password Confirmation:</label>
                            <input class="form-control" name="password_confirmation" type="password" id="password_confirmation" value="">
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <!-- Fullname Field -->
                        <div class="col-sm-6">
                            <label for="fullname">Fullname:</label>
                            <input class="form-control" name="fullname" type="text" id="fullname" value="{{ Auth::user()->fullname }}">
                        </div>
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
    <script>
        function viewImg(img) {
            var fileReader = new FileReader;
            fileReader.onload = function(img) {
                var avartarShow = document.getElementById("avartar-img-show");

                avartarShow.src = img.target.result
            }, fileReader.readAsDataURL(img.files[0])
        }
    </script>
@stop

@if(Session::has('success'))
    @section('scriptAlert')
    <script type="text/javascript">
        notes.show("{{ Session::get('success') }}", {
            type: 'success',
            title: 'Success',
            icon: '<i class="icon icon-check-sign"></i>'
        });
    </script>
    @endsection
@endif

@if(Session::has('fail'))
    @section('scriptAlert')
    <script type="text/javascript">
        notes.show("{{ Session::get('fail') }}", {
            type: 'danger',
            title: 'Error',
            icon: '<i class="icon icon-exclamation-sign"></i>'
        });
    </script>
    @endsection
@endif
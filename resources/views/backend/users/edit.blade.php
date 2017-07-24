@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Update User
        </h1>
    </section>

    <section class="content">
        @if($errors->count()>0)
            <ul class="alert alert-danger" style="list-style-type: none">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form method="POST" action="{{ route('users.update',$user->id) }}" accept-charset="UTF-8" id="user_update" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <!-- Name Field -->
                            <div class="col-sm-6">
                                <label for="name">Name:</label>
                                <input class="form-control" name="name" type="text" id="name" value="{{ $user->name }}">
                            </div>
                            <!-- Email Field -->
                            <div class="col-sm-6">
                                <label for="email">Email:</label>
                                <input class="form-control" name="email" type="email" id="email" value="{{ $user->email }}">
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
                                <input class="form-control" name="fullname" type="text" id="fullname" value="{{ $user->fullname }}">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Level Field -->
                            <div class="col-sm-6">
                                <label for="level">Level:</label>
                                <select name="level" id="level" class="form-control">
                                    <option value="1" @if($user->level) selected="selected" @endif>Admin</option>
                                    <option value="0" @if(!$user->level) selected="selected" @endif>User</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Avatar Field -->
                            <div class="col-sm-6">
                                <label for="avatar">Avatar:</label>
                                <input class="form-control" name="avatar" type="file" id="avatar" onchange="viewImg(this)">
                                <br>
                                <p><img id="avartar-img-show" src="{{ url("storage/avatars/$user->avatar") }}" alt="avatar" class="img-responsive" width="100px" height="100px"></p>
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
            </div>
        </div>
    </section>

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
@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add Users
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
                    <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8" id="user">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <!-- Name Field -->
                            <div class="col-sm-6">
                                <label for="name">Name:</label>
                                <input class="form-control" name="name" type="text" id="name">
                            </div>
                            <!-- Email Field -->
                            <div class="col-sm-6">
                                <label for="email">Email:</label>
                                <input class="form-control" name="email" type="email" id="email">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Password Field -->
                            <div class="col-sm-6">
                                <label for="password">Password:</label>
                                <input class="form-control" name="password" type="password" id="password">
                            </div>

                            <!-- Password Confirmation Field -->
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
                                <input class="form-control" name="fullname" type="text" id="fullname">
                            </div>
                            <!-- Level Field -->
                            <div class="col-sm-6">
                                <label for="level">Level:</label>
                                <select name="level" id="level" class="form-control">
                                    <option value="2">Super Admin</option>
                                    <option value="1">Admin</option>
                                    <option value="0" selected>User</option>
                                </select>
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

@stop
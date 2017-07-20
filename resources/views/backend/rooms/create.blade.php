@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Rooms
        </h1>
    </section>

    <section class="content">
        <ul class="alert alert-danger" style="list-style-type: none">
            <li>The name field is required.</li>
        </ul>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form method="POST" action="{{ route('rooms.store') }}" accept-charset="UTF-8" id="room">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <!-- Name Field -->
                            <div class="col-sm-12">
                                <label for="name">Name:</label>
                                <input class="form-control" name="name" type="text" id="name">
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group">
                            <!-- Submit Field -->
                            <div class="col-sm-12">
                                <input class="btn btn-primary" type="submit" value="Save">
                                <a href="index.php" class="btn btn-default">Back</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

@stop
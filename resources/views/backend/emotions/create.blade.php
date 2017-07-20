@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Emotions
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
                    <form method="POST" action="{{ route('emotions.store') }}" accept-charset="UTF-8" id="emotion" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <!-- Name Field -->
                            <div class="col-sm-6">
                                <label for="name">Name:</label>
                                <input class="form-control" name="name" type="text" id="name">
                            </div>
                            <!-- Code Field -->
                            <div class="col-sm-6">
                                <label for="code">Code:</label>
                                <input class="form-control" name="code" type="text" id="code">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Name Field -->
                            <div class="col-sm-6">
                                <label for="image">Image:</label>
                                <input class="form-control" name="image" type="file" id="image" onchange="viewImg(this)">
                                <br>
                                <p><img id="avartar-img-show" src="{{ asset('admin/images/avatar.png') }}" alt="avatar" class="img-responsive" width="50px" height="50px"></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group">
                            <!-- Submit Field -->
                            <div class="col-sm-12">
                                <input class="btn btn-primary" type="submit" value="Save">
                                <a href="{{ route('emotions.index') }}" class="btn btn-default">Back</a>
                            </div>
                            <div class="clearfix"></div>
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
@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Emotions
        </h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('emotions.create') }}">Add New</a>
        </h1>
    </section>

    <section class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                    <div class="alert alert-success"><p><strong>{{ Session::get('success') }}</strong></p></div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                @endif
                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>File Name</th>
                                    <th>Code</th>
                                    <th class="text-center" colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($emotions) <1)
                                <td colspan="5">List of emotions is empty!</td>
                            @else
                                @foreach($emotions as $emotion)
                                <tr>
                                    <td>{{ $emotion->name }}</td>
                                    <td><img src="{{ url("storage/emotions/$emotion->image") }}" width="30px"></td>
                                    <td>{{ $emotion->image }}</td>
                                    <td>{{ $emotion->code }}</td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('emotions.destroy', $emotion->id) }}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            {{ csrf_field() }}
                                            <div class='btn-group'>
                                                <a href="{{ route('emotions.show', $emotion->id) }}" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </a>
                                                <a href="{{ route('emotions.edit', $emotion->id) }}" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(&#039;Are you sure?&#039;)">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="pagination-sm no-margin pull-right">
                            {{ $emotions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
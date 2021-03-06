@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Files
        </h1>
    </section>

    <section class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                    <div class="alert alert-success"><p><strong>{{ Session::get('success') }}</strong></p></div>
                @endif
                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Room</th>
                                    <th>Type</th>
                                    <th>Uploaded By</th>
                                    <th class="text-center" colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($files) < 1 )
                                <td colspan="7" class="text-center">List of Files is empty!</td>
                            @else
                                @foreach($files as $file)
                                <tr>
                                    <td>{{ $file->title }}</td>
                                    <td>{{ $file->roomname }}</td>
                                    <td>{{ $file->type }}</td>
                                    <td>{{ $file->fullname }}</td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('files.destroy', $file->id ) }}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            {{ csrf_field() }}
                                            <div class='btn-group'>
                                                <a href="{{ route('files.show', $file->id) }}" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-eye-open"></i>
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
                            {{ $files->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
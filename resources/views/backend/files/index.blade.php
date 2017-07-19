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
                <div class="alert alert-success"><p><strong>Saved successfully.</strong></p></div>
                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Room</th>
                                    <th>Type</th>
                                    <th class="text-center" colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Eveniet, culpa unde saepe praesentium</td>
                                    <td>Illo nostrud autem.</td>
                                    <td>Sound</td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('files.destroy', 1) }}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            {{ csrf_field() }}
                                            <div class='btn-group'>
                                                <a href="{{ route('files.show', 1) }}" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(&#039;Are you sure?&#039;)">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                

                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="pagination-sm no-margin pull-right">
                            <ul class="pagination">
                                <li class="disabled"><span>&laquo;</span></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#" rel="next">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
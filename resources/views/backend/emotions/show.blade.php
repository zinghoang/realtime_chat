@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            Emotion's Information
        </h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('emotions.create') }}">Add New</a>
        </h1>
    </section>

    <section class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            <thead>
                                <tr class="info">
                                    <th class="text-center" colspan="2"><h3>EMOTION'S INFORMATION</h3></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $emotion->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $emotion->name }}</td>
                                </tr>
                                <tr>
                                    <td>Code</td>
                                    <td>{{ $emotion->code }}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td><img src="{{ url("storage/emotions/$emotion->image") }}" width="30px"></td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td class="text-success">{{ $emotion->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td class="text-danger">{{ $emotion->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
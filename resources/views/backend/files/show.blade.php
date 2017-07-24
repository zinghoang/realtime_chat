@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1 class="pull-left">
            File's Information
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
                                    <th class="text-center" colspan="2"><h3>FILE'S INFORMATION</h3></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $file[0]->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $file[0]->name }}</td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td>{{ $file[0]->title }}</td>
                                </tr>
                                <tr>
                                    <td>Room</td>
                                    <td>{{ $file[0]->roomname }}</td>
                                </tr>
                                <tr>
                                    <td>Full name</td>
                                    <td>{{ $file[0]->fullname }}</td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>{{ $file[0]->type }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td class="text-success">{{ $file[0]->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td class="text-danger">{{ $file[0]->updated_at }}</td>
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
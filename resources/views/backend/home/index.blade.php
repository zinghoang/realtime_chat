@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
    <h1>
        Home
    </h1>
</section>

<section class="content">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-folder-o" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ route('rooms.index') }}">Rooms</a></span>
                    <span class="info-box-number">{{ $countRooms }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-file-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ route('files.index') }}">File</a></span>
                    <span class="info-box-number">{{ $countFiles }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ route('users.index') }}">Users</a></span>
                    <span class="info-box-number">{{ $countUsers }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-smile-o" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="{{ route('emotions.index') }}">Emotions</a></span>
                    <span class="info-box-number">{{ $countEmotions }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">

            <!-- Chat box -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">User</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        	<i class="fa fa-minus"></i>
            			</button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                        	<i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                            </div>
                            <!-- ./chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="fa fa-circle-o text-red"></i> User</li>
                                <li><i class="fa fa-circle-o text-green"></i> Admin</li>
                                <li><i class="fa fa-circle-o text-yellow"></i> Super Admin</li>
                            </ul>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.box -->

            <!-- TO DO List -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">User register recent</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                    	@foreach ($userRecents as $key => $user)
                        <li>
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="User Image">
                            <a class="users-list-name" >{{ $user->fullname }}</a>
                            <span class="users-list-date">{{ $user->name }}</span>
                        </li>
                    	@endforeach
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{ route('users.index') }}" class="uppercase">Show all</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

            <!-- Map box -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">The biggest rooms</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Count of member</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                	@foreach ($bigRoom as $key => $room)
                                <tr>
                                		
                                    <td><a href="{{ route('rooms.show', $room->id) }}">{{ $room->name }}</a></td>
                                    <td class="text-center">
                                    	{{ $room->soLuong }}
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('rooms.destroy', $room->id) }}" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <div class='btn-group'>
                                                <a href="{{ route('rooms.show', $room->id) }}" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </a>
                                                <a href="{{ route('rooms.edit', $room->id) }}" class='btn btn-default btn-xs'>
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
                                                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{ route('rooms.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Create room</a>
                    <a href="{{ route('rooms.index') }}" class="btn btn-sm btn-default btn-flat pull-right">Show all rooms</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
</section>
<!-- /.content -->
</div>

@stop

@section('script')
    <!-- ChartJS 1.0.1 -->
<script src="{{ asset('admin/js/Chart.min.js') }}"></script>

<script>
    $(function() {
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            
            {
                value: {{ $countUsers }},
                color: "red",
                highlight: "red",
                label: "User"
            },
            {
                value: {{ $countAdmins }},
                color: "green",
                highlight: "green",
                label: "Admin"
            },
            {
                value: {{ $countSuperAdmins }},
                color: "yellow",
                highlight: "yellow",
                label: "Super Admin"
            },
            
            

        ];
        var pieOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 50,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
            maintainAspectRatio: true,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        pieChart.Doughnut(PieData, pieOptions);
    });
</script>
@endsection
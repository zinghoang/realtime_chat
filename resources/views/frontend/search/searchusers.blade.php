<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>User</h2>
    <div class="panel panel-primary">
      <div class="panel-heading">User</div>
      <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Fullname</th>
                    <th>Email</th>
                </thead>
                <tbody>
                    @if($users->count())
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->email }}</td>                               
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">There are no data.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $users->links() }}
      </div>
    </div>
</div>

</body>
</html>
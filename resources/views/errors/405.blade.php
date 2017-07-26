<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat Blue Team</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height content-page-error">

            <div class="content">
                <div class="title m-b-md">
                    Sorry!
                </div>

                <div style="font-size: 60px;">
                    405!!! Method not allowed!!!
                    <br>
                    <a href="{{ route('home') }}" style="text-decoration: none;">Go back</a>
                </div>
            </div>
        </div>
    </body>
</html>

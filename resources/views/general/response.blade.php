<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        *{
            transition: all 0.6s;
            font-family: sans-serif;
        }

        p{ font-size: 20px; }
        .error_code { font-weight: 600; }

        html {
            height: 100%;
        }

        body{
            font-family: 'Lato', sans-serif;
            color: #888;
            margin: 0;
        }

        #main{
            display: table;
            width: 100%;
            height: 100vh;
            text-align: center;
        }

        .section{
            display: table-cell;
            vertical-align: middle;
        }

        .section h1{
            font-size: 50px;
            display: inline-block;
            padding-right: 12px;
            animation: type .5s alternate infinite;
        }

        @keyframes type{
            from{box-shadow: inset -3px 0px 0px #888;}
            to{box-shadow: inset -3px 0px 0px transparent;}
        }
    </style>
</head>
<body>
    <div id="main">
        <div class="section">
            <h1>{{ $title }}</h1>
            <p class="text-{{ $status ? 'success' : 'danger' }}">{{ $message }}</p>
            <h3 class="error_code text-{{ $status ? 'success' : 'danger' }}">{{ $status ? 'Success' : 'Error' }} {{$status_code ?? ''}}</h3>

            @if($cta_label ?? null)
                <a href="{{$cta_link ?? '#'}}">{{$cta_label ?? ''}}</a>
            @endif

        </div>
    </div>
</body>
</html>
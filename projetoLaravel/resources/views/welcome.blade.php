<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel Course</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Styles -->
        <link rel="stylesheet" href="./resources/css/app.css">

    </head>
    <body>
        <h1>Hello world laravel</h1>

        @if(10 > 5)
            <p>True</p>
        @endif

        <p> {{$nome }} </p>

        @if($nome == 'gabiel')
        <p>o meu nome é {{$nome}} e tenho {{$idade}} anos.</p>
        @else
        <p>o meu nome não é {{$nome}} </p>
        @endif

        @for($i=0; $i < count($arr); $i++)
            <p>{{ $arr[$i]}} - {{$i}}</p>
        @endfor

        <script src="./resources/js/app.js"></script>
    </body>
</html>

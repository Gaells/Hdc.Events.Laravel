<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>titulo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Styles -->
        const mix = require('laravel-mix');

        mix.js('resources/js/app.js', 'public/js')
        .css('resources/css/app.css', 'public/css');

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
    </body>
</html>

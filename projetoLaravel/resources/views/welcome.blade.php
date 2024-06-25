@extends('layouts.main')

@section('title', 'HDC Events')


@section('content')
<h1>Algum titulo</h1>

@if (10 > 5)
    <p>condição é true</p>
@endif

<p>{{$nome}}</p>

@if ($nome == 'Pedro')
    <p>O nome é pedro</p>
@elseif($nome == 'Gabriel')
    <p>o nome é {{$nome}}</p>
@else
    <p>nome n é {{$nome}}</p>
@endif

@for($i = 0; $i < count($arr); $i++)
    <p>{{ $arr[$i] }} - {{ $i }} </p>
@endfor

@endsection
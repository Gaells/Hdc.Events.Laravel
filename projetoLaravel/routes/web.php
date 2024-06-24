<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $nome = 'gabriel';
    $idade = 25;
    $arr = [10, 20, 30, 40, 50];

    return view('welcome',
            [
                'nome' => $nome,
                'idade'=> $idade,
                'arr' => $arr
            ]);
    });

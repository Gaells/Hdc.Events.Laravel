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


Route::get('/produtos', function() {

    // query parameters
    $busca = request('search');

    return view('products', ['busca' => $busca]);
});

// rota com parametros opcionais
// se uso sem o ?, fica com parametros obrigatorios
Route::get('/produtos_teste/{id?}', function($id = 1) {
    return view('product', ['id' => $id]);
});

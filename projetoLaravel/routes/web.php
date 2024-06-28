<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

//Padrões do laravel
//index mostra todos os registros
Route::get('/', [EventController::class, 'index']);
//create, criar registros no banco
Route::get('/events/create', [EventController::class, 'create']);
//show, mostrar um dado especifico
Route::get('/events/{id}', [EventController::class, 'show']);
//store, enviar os dados pro banco
Route::post('events', [EventController::class, 'store']);


Route::get('/contact', function() {
    return view('contact');
});

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {

        $nome = 'gabriel';
        $idade = 25;
        $arr = [10, 20, 30, 40, 50];

        return view('welcome',
            [
                'nome' => $nome,
                'idade'=> $idade,
                'arr' => $arr
            ]);
    }

    public function create() {
        return view('events.create');
    }

    public function contact() {
        return view('contatos');
    }

    public function products() {
        return view('product');
    }
}

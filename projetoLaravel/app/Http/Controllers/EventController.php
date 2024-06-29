<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index() {

        $search = request('search');

        if($search) {

            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $events = Event::all();
        }


        return view('welcome',['events' => $events, 'search' => $search]);
    }

    public function create() {
        return view('events.create');
    }

    public function contact() {
        return view('contatos');
    }

    public function store(Request $request) {

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;

        //para items tem que alterar o model para identificar que vai vir um array e não uma string
        $event->items = $request->items;

        //image upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            //criando uma hash para ter um novo exclusivo de cada imagem e não haver colisão
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            //aqui é igual aos outros, esta salvando
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        // salvo e retorno o usuario para a home
        //with é a flash message
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {

        $event = Event::findOrFail($id);

        //evento cru
        return view('events.show', ['event' => $event]);
    }
}



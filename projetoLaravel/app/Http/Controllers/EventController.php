<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        $user = auth()->user();

        $hasUserJoined = false;

        if($user) {
            $userEvents = $user->eventAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        //evento cru
        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        $eventAsParticipant = $user->eventAsParticipant;

        return view('events.dashboard', [
            'events' => $events,
            'eventasparticipant' => $eventAsParticipant
        ]);
    }

    public function destroy($id)
    {
        // Encontre o evento
        $event = Event::findOrFail($id);

        // Remova todas as associações de participantes
        $event->users()->detach();

        // Delete o evento
        $event->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }


    public function edit($id) {
        // verifica se o user é o dono do evento na hora de edição acessada via url
        // caso n for, é barrado
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);

    }

    public function update(Request $request) {

        $data = $request->all();

        //image upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            //aqui é igual aos outros, esta salvando
            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }

    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada em ' . $event->title);

    }

    public function leaveEvent($id) {

        $user = auth()->user();

        $user->eventAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença no evento: ' . $event->title . ' foi removida');

    }

}



<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistorialExport;
use Livewire\Livewire;

class TicketsController extends Controller
{


    /*   VISTA FILTRO */
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    /* VISTA HISTORIAL */
    public function historial()
    {
        Gate::allowIf(Auth::user()->usertype == "encargado" || Auth::user()->usertype == "gestec");
        $tickets = Ticket::all();
        $users = User::all();

        return view('tickets.historial', compact('tickets', 'users'));
    }
    /*     VISTA DE USUARIOS  */
    public function usuarios()
    {
        Gate::allowIf(Auth::user()->usertype == "encargado" || Auth::user()->usertype == "gestec");
      
        return view('tickets.usuarios');
    }
    /* STORE MAESTRO */
    public function storeMaestro(Request $request)
    {
        $request->validate([
            'aula' => ['required'],
            'edificio' => ['required'],
            'problematica' => ['required', 'max:75'],
            'detalles' => ['required']
        ]);

        $ticket = new Ticket();

        $ticket->aula = $request->aula;
        $ticket->edificio = $request->edificio;
        $ticket->problematica = $request->problematica;
        $ticket->detalles = $request->detalles;

        $ticket->estatus = "Pendiente";


        $ticket->creadoPor = 'Maestro';

        $ticket->save();

        Alert::success('Ticket Enviado', '¡El ticket se ha enviado correctamente!');

        return redirect()->back();
    }

    public function show(String $id)
    {
        Gate::allowIf(Auth::user()->usertype == "encargado" || Auth::user()->usertype == "gestec" || Auth::user()->usertype == 'usuario');
        $ticket = Ticket::findOrFail($id);
        $users = User::all();
        $comentarios = $ticket->comentarios;

        return view('tickets.show', compact('ticket', 'users', 'comentarios'));
    }


    /* CREAR TICKET INTERNO */
    public function store(Request $request)
    {
        //Gate::allowIf(Auth::user()->usertype == "encargado" || Auth::user()->usertype == "gestec" || Auth::user()->usertype == 'usuario');   
        $request->validate([
            'aula' => ['required'],
            'edificio' => ['required'],
            'problematica' => ['required', 'max:75'],
            'detalles' => ['required']
        ]);

        $ticket = new Ticket();

        $ticket->aula = $request->aula;
        $ticket->edificio = $request->edificio;
        $ticket->problematica = $request->problematica;
        $ticket->detalles = $request->detalles;

        if (strlen($request->user_id) > 0) {
            $ticket->estatus = "En proceso";
        } else {
            $ticket->estatus = "Pendiente";
            $ticket->creadoPor = "Maestro";
        }
        if (auth()->check()) {
            $ticket->creadoPor = auth()->user()->name;
        }

        $ticket->user_id = $request->user_id;



        $ticket->save();

        Alert::success('Ticket Enviado', '¡El ticket se ha enviado correctamente!');

        /*  return redirect()->back(); */
        return redirect()->route('tickets.index');
    }

    /*   ASIGNAR TICKET */
    public function asignarTicket(Request $request, String $id)
    {
        $request->validate([
            "user_id" => ["required"]
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->user_id = $request->user_id;

        $ticket->estatus = "En proceso";
        $ticket->save();
        toast('Ticket asignado', 'info');


        return redirect()->route('tickets.show', $ticket->id);
    }

    /* AutoAsignarTicket */
    public function autoAsignarTicket(String $id)
    {

        $ticket = Ticket::findOrFail($id);

        if ($ticket->estatus != "Realizado") {
            $ticket->user_id =  auth()->user()->id;
            $ticket->estatus = "En proceso";
            $ticket->save();

            toast('Ticket en proceso', 'info');

            return redirect()->route('tickets.show', $ticket->id);
        } else {

            alert()->error('Ticket ya realizado', 'No se puede asignar un ticket con estaus Realizado');
            return back();
        }
    }

    /*  TICKET REALIZADO */
    public function ticketRealizado(Request $request, String $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'comentarioFinal' => ['required']
        ]);

        if ($ticket->user_id == null) {
            return redirect()->route('tickets.show', $ticket->id);
        }

        $ticket->estatus = "Realizado";
        $ticket->fecha_finalizacion = now();
        $ticket->comentarioFinal = $request->input('comentarioFinal');
        $ticket->save();
        toast('¡Ticket realizado!', 'success');

        return redirect()->route('tickets.show', $ticket->id);
    }


    /*     TICKET EN ESPERA */
    public function ticketEnEspera(Request $request, String $id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->user_id == null) {
            return redirect()->route('tickets.show', $ticket->id);
        }
        $ticket->estatus = "En espera";
        $ticket->save();

        toast('Ticket en espera', 'question');


        return redirect()->route('tickets.show', $ticket->id);
    }
    
}

<?php

namespace App\Livewire;

use App\Models\Comentario;
 /* ACTIVAR PAGINACION */
use Livewire\WithPagination;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\DumpHandler;

class Filtro extends Component
{   /* ACTIVAR PAGINACION */
    use WithPagination;
   /*  DEFINICION DE VARIABLES */
    public $estatus;
    public $userSelect;
    public $users;
    public $edificio;
    public $folio;
    public $ticketsAll;
    public $misTickets;
    
  /*   MANDAR VARIABLE VISTA DE LIVEWIRE , FUNCION SI O SI MOUNT */
    public function mount()
    {
        $this->users = User::all();
        $this->ticketsAll = Ticket::all();
    }
    /* Borrar filtro de filtro */
    public function clearFiltro(){
        
        return redirect()->route('tickets.index');
    }
/* FILTROS GENERALES*/
    public function render()
    {
        $userType = auth()->user()->usertype;
            
        $tickets = Ticket::query()
         /*    FILTRO POR USERTYPE Y EDIFICIO */
            ->when($userType == 'salaDeListas', function ($query) {
                return $query->where(function ($query) {
                    $query
                        ->where('edificio', '>=', 'A')
                        ->where('edificio', '<=', 'G');
                });
            })

            ->when($userType == 'salaDeListas2', function ($query) {
                return $query->where(function ($query) {
                    $query
                        ->where('edificio', '>=', 'H')
                        ->where('edificio', '<=', 'J');
                });
            })

            ->when($userType == 'salaDeListas3', function ($query) {
                return $query->where(function ($query) {
                    $query
                        /* ->where('edificio', '>=', 'K')
                        ->where('edificio', '<=', 'N')
                        ->orWhere('creadoPor', 'Sala De Listas 3') */
                        ->where('edificio', '>=', 'K')
                        ->where('edificio', '<=', 'N');
                });
            })
            ->when($userType == 'usuario', function ($query) {
                return $query->where(function ($query) {
                    $query
                        ->where('estatus', '!=', 'Realizado');
                });
            })

            /* FILTRO POR FOLIO */
            ->when($this->folio, function ($query) {
                $query->where('id', $this->folio);
            })
            /* FILTRO POR ESTATUS */
            ->when($this->estatus, function ($query) {
                $query->where('estatus', $this->estatus);
            })
            /* FILTRO POR USUARIO  */
            ->when($this->userSelect, function ($query) {
                $query->where('user_id', $this->userSelect);
            })
            /* FILTRO POR EDIFICIO */
            ->when($this->edificio, function ($query) {
                $query->where('edificio', $this->edificio);
            })
            ->when($this->misTickets, function ($query) {
                $query->where('user_id',auth()->user()->id);
            })
                /* ORDEN DE TICKETS */
            ->orderByRaw("CASE 
        WHEN estatus = 'Pendiente' THEN 1 
        WHEN estatus = 'En espera' THEN 2 
        WHEN estatus = 'En proceso' THEN 3 
        WHEN estatus = 'Realizado' THEN 4
        ELSE 5 END")
            ->orderBy('created_at', 'asc')
          /*   INTEGRAR RELACION USER Y COMENTARIO */
            ->with('user', 'comentarios')
            ->paginate(10);
            
        return view('livewire.filtro', compact('tickets'));
    }
}

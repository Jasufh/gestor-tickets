<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\DumpHandler;

class Usuarios extends Component
{    use WithPagination;
    public $tickets;
    public $usuarioFiltro;    

    public function mount(){
      $this->tickets= Ticket::all();
     
    }
    public function render()
    {
        $users = User::query()
            ->when($this->usuarioFiltro, function ($query) {
                $query->where('name', 'like', '%' . $this->usuarioFiltro . '%')
                   ->OrWhere('apellidos', 'like', '%' . $this->usuarioFiltro . '%');
            })
            ->where('usertype','usuario')
            ->paginate(20);
    
        return view('livewire.usuarios', [
            'users' => $users,
        ]);
    }
    
}

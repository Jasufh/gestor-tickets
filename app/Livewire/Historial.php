<?php

namespace App\Livewire;

use App\Exports\HistorialExport;
use Livewire\WithPagination;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Historial extends Component
{
    /* DEFINICION DE VARIABLES Y PAGINADO */
    use WithPagination;
    public $inicio;
    public $fin;
    public $finalizados;
    public $users;
    /*     FUNCION PARA MOSTRAR VARIABLE */
    public function mount()
    {

        $this->users = User::all();
    }
    /* Limpia filtros xD */
    public function LimpiarFiltros()
    {
        return redirect()->route('tickets.historial');
    }
    /*  FILTROS GENERALES */
    public function render()
    {
        /* $userType = auth()->user()->usertype; */

        $tickets = Ticket::query()

            /*  ->when($userType == 'salaDeListas', function ($query) {
            $query->where('creadoPor', 'Sala De Listas');
        }) */
            /*  FILTRO DE RANGO DE FECHAS */
            ->when($this->inicio && $this->fin, function ($query) {
                $query->whereBetween('created_at', [$this->inicio, $this->fin]);
            })

            ->when($this->inicio && !$this->fin, function ($query) {
                $query->whereDate('created_at', $this->inicio);
            })

            ->when(!$this->inicio && $this->fin, function ($query) {
                $query->whereDate('fecha_finalizacion', $this->fin);
            })

            ->when($this->finalizados, function ($query) {
                $query->whereNotNull('fecha_finalizacion');
            })

            ->orderBy('fecha_finalizacion', 'desc')
            ->with('user')
            ->paginate(30);



        return view('livewire.historial', compact('tickets'));
    }

    public function exportExcel()
    {
        $tickets = Ticket::query()
            ->when($this->inicio && $this->fin, function ($query) {
                $query->whereBetween('created_at', [$this->inicio, $this->fin]);
            })
            ->when($this->inicio && !$this->fin, function ($query) {
                $query->whereDate('created_at', $this->inicio);
            })
            ->when(!$this->inicio && $this->fin, function ($query) {
                $query->whereDate('fecha_finalizacion', $this->fin);
            })
            ->when($this->finalizados, function ($query) {
                $query->whereNotNull('fecha_finalizacion');
            })
            ->orderBy('fecha_finalizacion', 'desc')
            ->get();

        return Excel::download(new HistorialExport($tickets), 'reporte-tickets.xlsx');
    }
}

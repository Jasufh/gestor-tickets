<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Ticket;
use Illuminate\Support\Collection;

class HistorialExport implements FromCollection, WithHeadings
{
    protected $tickets;

    public function __construct(Collection $tickets)
    {
        $this->tickets = $tickets;
    }
    public function collection()
    {
        return $this->tickets->map(function ($ticket) {
            return [
                'Folio' => $ticket->id,
                'Problematica' =>$ticket->problematica,
                'Creado por : ' => $ticket->creadoPor,
                'Asignado a:' => $ticket->user->name ?? '',
                'Fecha de creación' => \Carbon\Carbon::parse($ticket->created_at)->format('d-m-Y H:i:s'),
                'Fecha de finalización' => $ticket->fecha_finalizacion ? \Carbon\Carbon::parse($ticket->fecha_finalizacion)->format('d-m-Y H:i:s') : '',
                'Duración' => $ticket->fecha_finalizacion ? \Carbon\Carbon::parse($ticket->created_at)->diff(\Carbon\Carbon::parse($ticket->fecha_finalizacion)) : 'Sin finalizar',
                'Comentario final' => $ticket->comentarioFinal ?? '',
            ];
            
        });
    }

    public function headings(): array
    {
        return [
            'Folio',
            'Problematica',
            'Creado por',
            'Nombre de usuario',
            'Fecha de creación',
            'Fecha de finalización',
            'Duración',
            'Comentario final'
        ];
    }
}

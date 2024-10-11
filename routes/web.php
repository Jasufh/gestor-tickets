<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProblematicaController;
use App\Http\Controllers\WelcomeController;
use App\Htpp\Controllers\QrController;
use Illuminate\Support\Facades\Route;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\exportExcel;
use App\Livewire\Historial;
use Livewire\Livewire;

/* FORMULARIO MAESTRO */

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
/* Route::get('/qr',[QrController::class, 'QrController'])->name('qr'); */

//CREAR TICKET EXTERNO 'CREADO POR MAESTRO'
Route::post('/tickets/store/maestro', [TicketsController::class, 'storeMaestro'])->name('tickets.storeMaestro');



Route::middleware('auth')->group(function () {
    //HISTORIAL ->ruta exportarexcel
    Route::get('/tickets/historial', [TicketsController::class, 'historial'])->name('tickets.historial');

    //USUARIOS
    Route::get('/tickets/usuarios', [TicketsController::class, 'usuarios'])->name('tickets.usuarios');
    Route::get('/profile/crear-usuario', [ProfileController::class, 'add'])->name('profile.add');
    Route::post('/profile/store', [RegisteredUserController::class, 'store'])->name('profile.store');

    //PERFIL 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //TICKET(S)
    Route::get('/tickets', [TicketsController::class, 'index'])->middleware('verified')->name('tickets.index');
    Route::get('/tickets/{id}', [TicketsController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{id}/asignar-ticket', [TicketsController::class, 'asignarTicket'])->name('ticket.update');
    Route::post('/tickets/{id}/auto-asignar', [TicketsController::class, 'autoAsignarTicket'])->name('ticket.autoupdate');
    Route::post('/tickets/{id}/realizado', [TicketsController::class, 'ticketRealizado'])->name('ticket.realizado');
    //Comentarios
    Route::post('/tickets/{id}/store', [ComentarioController::class, 'store'])->name('comentario.store');
    Route::post('/tickets/{id}/comentario-en-espera', [TicketsController::class, 'ticketEnEspera'])->name('ticket.espera');

    //CREAR TICKET INTERNO
    Route::get('/profile/ticket', [ProfileController::class, 'addticket'])->name('profile.addticket');
    Route::post('/tickets/store', [TicketsController::class, 'store'])->name('tickets.store');

    Route::get('export/Excel', [TicketsController::class, 'exportExcel'])->name('exportExcel');


    //PROBLEMATICA
    Route::get('/profile/problematica', [ProblematicaController::class, 'index'])->name('problem.index');
    Route::post('/profile/problematica/store', [ProblematicaController::class, 'store'])->name('problem.store');
    Route::delete('/profile/problematica/{id}/delete', [ProblematicaController::class, 'delete'])->name('problem.delete');
    Route::patch('/profile/problematica/{id}/update', [ProblematicaController::class, 'update'])->name('problem.update');
});

require __DIR__ . '/auth.php';

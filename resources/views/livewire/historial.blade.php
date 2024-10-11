<div>
    {{-- HEADER DESCARGAR REPORTE --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="d-flex justify-content-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Historial') }}
                </h2>
                <button class="btn btn-outline-danger btn-sm d-flex align-items-center " wire:click='exportExcel'>
                    Descargar Reporte
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"
                        style="margin-left: 4px;">
                        <path
                            d="M13.03 8.22a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L3.47 9.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018l2.97 2.97V3.75a.75.75 0 0 1 1.5 0v7.44l2.97-2.97a.75.75 0 0 1 1.06 0Z"
                            fill="currentColor"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" mt-1 d-inline-flex bg-white rounded-2 p-1 mb-2">
                <a href="{{ route('tickets.index') }}"
                    class="mr-2 flex items-center link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                    <span class="ml-2">Regresar</span>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            {{-- FILTRO INICIO --}}
                            <div class="">
                                <label for="inicio">Filtrar por fecha de creación</label>
                                <input wire:model.live='inicio' type="date" class="w-100 mb-4 rounded-3"
                                    name="inicio" required>
                                </input>
                            </div>
                            {{-- FILTRO FIN --}}
                            <div class="ml-3">
                                <label for="fin">Filtrar por fecha de finalización</label>
                                <input wire:model.live='fin' type="date" class="w-100 mb-4 rounded-3" name="fin"
                                    required>
                                </input>
                            </div>
                        </div>
                        {{-- CHECKBOX FILTRO --}}
                        <div class="d-flex ml-1">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                wire:model.live="finalizados">
                            <label class="form-check-label ml-1" for="flexCheckDefault">
                                Mostrar solo finalizados
                            </label>
                        </div>
                        {{--  Quitar filtros --}}
                        <div class="d-flex ml-1  md-mt-3">
                            <button wire:click="LimpiarFiltros" class="btn btn-outline-danger  w-10 " type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                    fill="currentColor" class="bi bi-eraser-fill  vertical-align: middle;"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z" />
                                </svg>
                            </button>
                            <label class="ml-1"> Borrar Filtros</label>
                        </div>
                    </div>
                    {{-- TABLA  encabezado --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>

                                <tr>
                                    <th scope="col">Folio</th>
                                    <th scope ="col">Problematica</th>
                                    <th scope="col">Creado por:</th>
                                    <th scope="col">Asignado a:</th>
                                    <th scope="col">Fecha de Creación</th>
                                    <th scope="col">Fecha de Finalización</th>
                                    <th scope="col">Duración </th>
                                    <th scope="col"> Comentario Final</th>
                                    <th scope="col"> </th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>#{{ $ticket->id }}</td>
                                        <td>{{ $ticket->problematica }}</td>
                                        <a href="{{ route('tickets.show', $ticket->id) }}">
                                            <td>{{ $ticket->creadoPor }}</td>
                                        </a>
                                        @isset($ticket->user->id)
                                            <td><b>{{ $ticket->user->name }}</b></td>
                                        @else
                                            <td><i>Sin asignar</i></td>
                                        @endisset
                                        <td>{{ $ticket->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                            @if ($ticket->estatus === 'Realizado' && $ticket->fecha_finalizacion)
                                                {{ \Carbon\Carbon::parse($ticket->fecha_finalizacion)->format('d-m-Y H:i:s') }}
                                            @else
                                                <b><i>Sin finalizar</i></b>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($ticket->estatus === 'Realizado' && $ticket->fecha_finalizacion)
                                                {{ $ticket->created_at->diff($ticket->fecha_finalizacion) }}
                                            @else
                                                <b><i>Sin finalizar</i></b>
                                            @endif
                                        </td>
                                        {{-- comentario final --}}
                                        <td>
                                            <p class="text-break">{{Str::limit($ticket->comentarioFinal, 50)}}</p>
                                        </td>
                                        {{--  termina comentario final --}}

                                        {{-- Boton ver mas  --}}
                                        <td>
                                            <button
                                                class="btn btn-outline-primary btn-sm d-flex align-items-center borderless "
                                                type="button"
                                                onclick="window.location.href = '{{ route('tickets.show', $ticket->id) }}'">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    width="16" height="16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"
                                                        fill="currentColor" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    {{--      termina boton --}}
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center flex-column">
                            {!! $tickets->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

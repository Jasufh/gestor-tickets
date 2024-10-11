{{-- VISTA DE USUARIOS --}}
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
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
            {{-- TABLA HEADER --}}
            <div class="table-responsive">
                {{-- Search Uusario --}}
                <div class="justify-content-center mb-2 d-flex  mt-2">
                    <span class="input-group-text w-25 " style="background-color: #ffffff; border: none; padding:0% ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-search mr-3 mb-3" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                            </path>
                        </svg>
                        <input wire:model.live="usuarioFiltro" type="search" class="form-control rounded-3 w-100 mb-3"
                            placeholder="Buscar Usuario"aria-describedby="basic-addon1">
                    </span>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Usuarios</th>
                            <th scope="col">Email</th>
                            <th scope="col">Creado el:</th>
                            <th scope="col"> Tickets Realizados</th>
                        </tr>
                    </thead>
                    {{-- TABLA CONTENIDO --}}
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @if ($user->usertype == 'usuario')
                                    <td>
                                        {{ $user->name }} {{ $user->apellidos }}
                                    </td>
                                    <td>{{ $user->email }}


                                    <td>{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        @php $totalTickets = 0;@endphp
                                        @php $ticketsRealizados = 0;@endphp
                                        @foreach ($tickets as $ticket)
                                            @if ($user->id == $ticket->user_id)
                                                @php
                                                    $totalTickets++;
                                                @endphp
                                            @endif
                                            @if ($ticket->estatus == 'Realizado' && $user->id == $ticket->user_id)
                                                @php
                                                    $ticketsRealizados++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($totalTickets)
                                        @else
                                        @endif
                                        @php
                                            if ($totalTickets <= 0) {
                                                $totalTickets = 2;
                                            }
                                            $progreso = 0;
                                            $progreso = ($ticketsRealizados * 100) / $totalTickets;
                                        @endphp
                                        <div class="progress" role="progressbar" aria-label="succes" aria-valuenow="100"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success " style="width:{{ $progreso }}%">
                                                {{ number_format($progreso, 0) }}%</div>
                                        </div>

                                    </td>
                                @endif
                            </tr>
                        @endforeach                   
                    </tbody>
                </table>
        {{--         Paginado --}}
                <div class="d-flex justify-content-center flex-column">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
        <div>
        </div>

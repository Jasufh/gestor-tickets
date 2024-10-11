{{-- VISTA SHOW DONDE SE MUESTRAN LOS DETALLES DEL TICKET --}}
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight col-md-5">
                Detalles de ticket #{{ $ticket->id }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight col-md-4">
                Creado por {{ $ticket->creadoPor }}
            </h2>
        </div>
    </x-slot>


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" mt-1 d-inline-flex bg-white rounded-2 p-1 mb-2">

                @if (url()->previous() == route('tickets.historial'))
                <a href="  {{ route('tickets.historial') }}" @else <a href="  {{ route('tickets.index') }}"
                        @endif
                        class="mr-2 flex items-center link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        <span class="ml-2">Regresar</span>
                    </a>
            </div>
            {{-- Tabla --}}
            <div class="p-4 bg-white shadow-sm rounded-3">
                <div class="d-grid gap-2 mb-3 ">
                    <container class="d-flex justify-content-between w-100 ">
                        <div>
                            <b>
                                <p>Fecha de creación</p>
                            </b>
                            {{ $ticket->created_at }}
                        </div>

                        <div>
                            {{-- BUTTON FINALIZAR TICKET --}}
                            @if (Auth::user()->usertype == 'gestec' || Auth::user()->usertype == 'usuario' || Auth::user()->usertype == 'encargado')
                                @if ($ticket->estatus !== 'Realizado')
                                    <button type="button" class="btn btn-outline-success"
                                        @if (
                                            $ticket->user_id !== Auth::user()->id &&
                                                Auth::user()->usertype !== 'gestec' &&
                                                $ticket->user_id !== null &&
                                                Auth::user()->usertype !== 'encargado') data-bs-title="Ticket asignado a otro usuario" data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        @elseif ($ticket->user_id == null) 
                                        data-bs-title="Ticket sin asignar" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                        
                                    @else
                                        data-bs-toggle="modal" data-bs-target="#finzalizarModal" @endif>
                                        Finalizar Ticket
                                    </button>
                                @endif
                            @endif


                            {{-- MODAL FINALIZAR TICKET --}}
                            <div class="modal fade" id="finzalizarModal" tabindex="-1"
                                aria-labelledby="finzalizarModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="finzalizarModalLabel">Agrega
                                                un
                                                comentario final
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('ticket.realizado', $ticket->id) }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="message-text1"
                                                        class="col-form-label">Comentario:</label>
                                                    <textarea class="form-control" rows="10" id="message-text1" name="comentarioFinal" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <x-primary-button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</x-primary-button>
                                                <x-primary-button type="submit" class="btn btn-primary">Finalizar
                                                    Ticket</x-primary-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </container>
                <div class="container-fluid text-center mt-5">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row ">
                                        <div class="col-md-4">
                                            <b>
                                                <p>Aula</p>
                                            </b>
                                            {{ $ticket->aula }}
                                            {{-- Comentario final --}}
                                            <div class="mt-5">
                                                <b>
                                                    <p>Comentario Final</p>
                                                </b>
                                                @isset($ticket->comentarioFinal)
                                                    <p class="text-break">{{ $ticket->comentarioFinal }}</p>
                                                @else
                                                    <i>Sin comentario final</i>
                                                @endisset

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <b>
                                                <p>Problemática</p>
                                            </b>
                                            {{ $ticket->problematica }}
                                        </div>
                                        <div class="col-md-4">
                                            <b>
                                                <p>Estatus</p>
                                            </b>
                                            <span
                                                class="badge
                                                @if ($ticket->estatus === 'Pendiente') text-bg-warning 
                                                @elseif($ticket->estatus === 'En proceso') text-bg-primary
                                                @elseif($ticket->estatus === 'En espera') text-bg-secondary 
                                                @elseif($ticket->estatus === 'Realizado') text-bg-success @endif">
                                                {{ $ticket->estatus }}
                                            </span>
                                            <div class="mt-5">
                                                <b>
                                                    <p>Asignado a :</p>
                                                </b>
                                                @isset($ticket->user_id)
                                                    <p>{{ $ticket->user->name }}</p>
                                                @else
                                                    <i>Sin asignar</i>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- DETALLES --}}
                                <div class="col-md-12 mb-5">
                                    <b>
                                        <p>Detalles</p>
                                    </b>
                                    <p class="text-break"> {{ $ticket->detalles }}</p>
                                </div>
                                <div class="col-12 d-flex justify-content-center py-5">
                                    @if (Auth::user()->id == $ticket->user_id ||
                                            Auth::user()->usertype == 'usuario' ||
                                            Auth::user()->usertype == 'gestec'||
                                            Auth::user()->usertype == 'encargado')
                                        @if ($ticket->estatus == 'En espera' || $ticket->estatus == 'Pendiente')
                                            <form method="POST"
                                                action="{{ route('ticket.autoupdate', $ticket->id) }}">
                                                @csrf
                                                <button
                                                    class="btn btn-outline-primary btn-sm d-flex align-items-center mt-5"
                                                    type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Tomar Ticket">
                                                    En proceso
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-person-walking"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0M6.44 3.752A.75.75 0 0 1 7 3.5h1.445c.742 0 1.32.643 1.243 1.38l-.43 4.083a1.8 1.8 0 0 1-.088.395l-.318.906.213.242a.8.8 0 0 1 .114.175l2 4.25a.75.75 0 1 1-1.357.638l-1.956-4.154-1.68-1.921A.75.75 0 0 1 6 8.96l.138-2.613-.435.489-.464 2.786a.75.75 0 1 1-1.48-.246l.5-3a.75.75 0 0 1 .18-.375l2-2.25Z" />
                                                        <path
                                                            d="M6.25 11.745v-1.418l1.204 1.375.261.524a.8.8 0 0 1-.12.231l-2.5 3.25a.75.75 0 1 1-1.19-.914zm4.22-4.215-.494-.494.205-1.843.006-.067 1.124 1.124h1.44a.75.75 0 0 1 0 1.5H11a.75.75 0 0 1-.531-.22Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            @if (Auth::user()->id == $ticket->user_id || Auth::user()->usertype == 'gestec' || Auth::user()->usertype == 'encargado')
                                                @if ($ticket->user_id !== null && $ticket->estatus !== 'Realizado')
                                                    <form method="POST"
                                                        action="{{ route('ticket.espera', $ticket->id) }}">
                                                        @csrf
                                                        <button
                                                            class="btn btn-outline-secondary btn-sm d-flex align-items-center mt-5"
                                                            type="submit" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="En caso de NO no poder concluir el ticket agregalo en ESPERA y añade un comentario con el motivo. ">
                                                            Agregar en espera
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                {{-- ASIGNAR TICKET --}}
                                <div class="col-12 d-flex justify-content-center mb-5">
                                    @if (Auth::user()->usertype == 'gestec' || Auth::user()->usertype == 'encargado')
                                        @if ($ticket->estatus !== 'Realizado')
                                            <form method="post" action="{{ route('ticket.update', $ticket->id) }}">
                                                @csrf
                                                <b>
                                                    <p>Asignar a:</p>
                                                </b>
                                                <div class="col-6 col-md-3 w-60">
                                                    <select class="js-example-basic-single  w-100 mb-4 rounded-3"
                                                        name="user_id" aria-label="Selecciona usuario">
                                                        <option value="" selected>Selecciona usuario</option>
                                                        @foreach ($users as $user)
                                                            @if ($user->usertype == 'encargado' || $user->usertype == 'gestec' || $user->usertype == 'usuario')
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name }}</option>
                                                            @else
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <select id="asignar-select" name="user_id"
                                                class="form-select form-select-sm w-60  rounded-3 mx-auto "
                                                aria-label="Small select example">
                                                <option value="">Selecciona usuario</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select> --}}
                                                @error('user_id')
                                                    <p class="ms-2 mt-1 text-start text-danger">Selecciona un usuario</p>
                                                @enderror
                                                <div class="text-center py-3">
                                                    <button type="submit"
                                                        class="btn btn-primary rounded-3">Asignar</button>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" style="max-height: 440px; overflow-y: auto; "id="scrollableDiv">

                            <div class="shadow rounded-3 @if ($comentarios->count() == 0) py-3 @endif">
                                <b>
                                    <p>Comentarios</p>
                                </b>
                                @if ($comentarios->count() == 0)
                                    <p><i>Sin comentarios</i></p>
                                @endif
                                <div>
                                    @if ($comentarios->count() > 0)
                                        @foreach ($comentarios as $comentario)
                                            <div class="d-flex ">
                                                <div class="mt-6 bg-white border-0 border-top">
                                                    <div class="p-6 flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                        </svg>
                                                        <div>
                                                            <div>
                                                                <div>
                                                                    <span
                                                                        class="text-gray-800">{{ $comentario->user->name }}</span>
                                                                    <small
                                                                        class="ml-2 text-sm text-gray-600">{{ $comentario->created_at->format('j M Y, g:i a') }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                            <p
                                                                class="mt-4 text-lg text-gray-900 text-break text-start">
                                                                {{ $comentario->body }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($ticket->estatus !== 'Realizado')
                                            <form class=" rounded-3 bg-white shadow-sm rounded-lg"
                                                style="outline: none"
                                                action="{{ route('comentario.store', $ticket->id) }}" method="POST">
                                                @csrf
                                                <div class="d-flex mb-3 border-0 border-top w-100">

                                                    <form class="rounded-3 bg-white shadow-sm rounded-lg"
                                                        style="outline: none"
                                                        action="{{ route('comentario.store', $ticket->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input class="border-0 w-100 rounded  "
                                                            placeholder="responder..." name="body">
                                                        <button class="px-4" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-send"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                                                            </svg>
                                                        </button>
                                                </div>
                                            </form>
                                        @endif
                                    @else
                                        @if ($ticket->estatus !== 'Realizado')
                                            {{-- BUTTON AGREGAR PRIMER COMENTARIO --}}
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">Agrega un
                                                comentario
                                            </button>
                                        @endif

                                        {{-- MODAL AGREGAR PRIMER COMENTARIO --}}
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agrega
                                                            un
                                                            comentario
                                                        </h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST"
                                                        action="{{ route('comentario.store', $ticket->id) }}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="message-text1"
                                                                    class="col-form-label">Comentario:</label>
                                                                <textarea class="form-control" rows="10" id="message-text1" name="body"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <x-primary-button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</x-primary-button>
                                                            <x-primary-button type="submit"
                                                                class="btn btn-primary">Agregar</x-primary-button>
                                                        </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Select2 de asignar usuario --}}
                    <script>
                        $(document).ready(function() {
                            $('.js-example-basic-single').select2();
                        });
                    </script>
                    {{--  Block scroll comentarios --}}
                    <script>
                        var scrollableDiv = document.getElementById('scrollableDiv');

                        function scrollToEnd() {
                            scrollableDiv.scrollTop = scrollableDiv.scrollHeight - scrollableDiv.clientHeight;
                        }
                        scrollToEnd();
                    </script>
</x-app-layout>

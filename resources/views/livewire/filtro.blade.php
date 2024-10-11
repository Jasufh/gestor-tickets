<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="container">
                    <div class="row justify-content-start">
                        {{-- FILTRO POR FOLIO --}}
                        <div class="col-6 col-md-3 mb-2 d-flex" wire:ignore>
                            <span class="input-group-text w-100"
                                style="background-color: #ffffff; border: none; padding:0%">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-search mr-3 mb-3" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                    </path>
                                </svg>
                                <input wire:model.live="folio" type="search" class="form-control rounded-3 w-100 mb-3"
                                    placeholder="Filtro por folio"aria-describedby="basic-addon1">
                            </span>
                        </div>
                        {{--  FILTRO POR USUARIO --}}
                        {{--  componente --}}
                        @if (Auth::user()->usertype == 'encargado' || Auth::user()->usertype == 'gestec' || Auth::user()->usertype == 'usuario')
                            <div class="col-6 col-md-3" wire:ignore>
                                <x-select2-usuarios name='userSelect' :users="$users"
                                    class="w-100 mb-3 rounded-3">Filtro por usuario</x-select2-usuarios>
                            </div>
                        @endif
                        {{-- Filtro por ESTATUS --}}
                        <div class="col-6 col-md-3">
                            <select wire:model.live='estatus' class="form-select form-select-sm w-100 mb-4 rounded-3"
                                name="estatus" aria-label="Filtrar por estatus">
                                <option value="" selected>Filtrar por estatus</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="En proceso">En proceso</option>
                                <option value="En espera">En espera</option>
                                @if (Auth::user()->usertype !='usuario')
                                <option value="Realizado">Realizado</option>
                                @endif
                                <option value="">Todos</option>
                            </select>
                        </div>
                        {{-- FILTRAR POR EDIFICIO --}}
                        <div class="col-6 col-md-3">
                            <select wire:model.live='edificio' class="w-100 mb-4 rounded-3" name="edificio"
                                aria-label="Filtrar por Edificio" id="selectEdificio">

                                <option value="" selected>Filtrar por edifcio</option>
                                @if (Auth::user()->usertype == 'salaDeListas' ||
                                        Auth::user()->usertype == 'usuario' ||
                                        Auth::user()->usertype == 'gestec' ||
                                        Auth::user()->usertype == 'encargado')
                                    <option value='A'>A</option>
                                    <option value='B'>B</option>
                                    <option value='C'>C</option>
                                    <option value='D'>D</option>
                                    <option value='E'>E</option>
                                    <option value='F'>F</option>
                                    <option value='G'>G</option>
                                @endif
                                @if (Auth::user()->usertype == 'salaDeListas2' ||
                                        Auth::user()->usertype == 'usuario' ||
                                        Auth::user()->usertype == 'gestec' ||
                                        Auth::user()->usertype == 'encargado')
                                    <option value='H'>H</option>
                                    <option value='I'>I</option>
                                    <option value='J'>J</option>
                                @endif
                                @if (Auth::user()->usertype == 'salaDeListas3' ||
                                        Auth::user()->usertype == 'usuario' ||
                                        Auth::user()->usertype == 'gestec' ||
                                        Auth::user()->usertype == 'encargado')
                                    <option value='K'>K</option>
                                    <option value='L'>L</option>
                                    <option value='M'>M</option>
                                    <option value='N'>N</option>
                                @endif
                            </select>
                        </div>

                    </div>

                    {{-- TABLA HEADER --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Folio</th>
                                    <th scope="col">Problemática</th>
                                    <th scope="col">Asignado a:</th>
                                    <th scope="col">Creado por:</th>
                                    <th scope="col">Aula</th>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col">Comentarios</th>
                                    <th scope="col">Estatus</th>
                                    @if (Auth::user()->usertype == 'gestec' || Auth::user()->usertype == 'encargado' || Auth::user()->usertype == 'usuario')
                                        <th scope="col">Acciones</th>
                                    @endif
                                    <div class="d-flex justify-content-end ml-1  md-mt-3 mb-3">
                                        {{-- CHECKBOX SOLO MIOS --}}
                                        @if (Auth::user()->usertype == 'usuario')
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                                wire:model.live="misTickets">
                                            <label class="form-check-label ml-1" for="flexCheckDefault">
                                                Mostrar solo mis Tickets
                                            </label>
                                        @endif
                                        <span class="ml-4"></span>
                                        {{--  Borrar filtros --}}
                                        <button wire:click="clearFiltro" class="btn btn-outline-danger  w-10 "
                                            type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Borrar Filtros">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                fill="currentColor" class="bi bi-eraser-fill  vertical-align: middle;"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z" />
                                            </svg>
                                        </button>
                                    </div>
                                </tr>
                            </thead>
                            {{-- TABLA CONTENIDO --}}
                            <tbody class="text-center">
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>#{{ $ticket->id }}</td>
                                        <td>{{ $ticket->problematica }}</td>
                                        @isset($ticket->user->id)
                                            <td><b>{{ $ticket->user->name }}</b></td>
                                        @else
                                            <td><i>Sin asignar</i></td>
                                        @endisset
                                        <td>{{ $ticket->creadoPor }}</td>
                                        <td>{{ $ticket->edificio }}-{{ $ticket->aula }}</td>
                                        <td>{{ $ticket->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                            {{-- BUTTON VER COMENTARIO --}}
                                            @if (strlen($ticket->comentarioFinal) > 0 or $ticket->comentarios->count() > 0)
                                                <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $loop->iteration }}">Ver
                                                    comentario
                                                </button>   
                                            @endif
                                            {{-- MODAL VER COMENTARIO --}}
                                            <div class="modal fade" id="exampleModal{{ $loop->iteration }}"
                                                aria-labelledby="exampleModalLabel{{ $loop->iteration }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="exampleModalLabel{{ $loop->iteration }}">
                                                                Comentario
                                                                Final:</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card card-body">
                                                                <div class="modal-body">
                                                                    {{ $ticket->comentarioFinal }}
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="accordion" id="accordionExample">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="headingOne">
                                                                        <button class="accordion-button"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseOne"
                                                                            aria-expanded="true"
                                                                            aria-controls="collapseOne">
                                                                            <span
                                                                                class="position-relative">Comentarios</span>
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapseOne"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#accordionExample">
                                                                        <div class="accordion-body">
                                                                            @if ($ticket->comentarios->count() > 0)
                                                                                @foreach ($ticket->comentarios as $comentario)
                                                                                    <div
                                                                                        class="border-bottom d-flex mt-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            class="h-6 w-6 text-gray-600 -scale-x-100"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                                                        </svg>
                                                                                        <div>
                                                                                            <div>
                                                                                                <div>
                                                                                                    <span
                                                                                                        class="text-gray-800">{{ $comentario->user->name }}</span>
                                                                                                    <small
                                                                                                        class="ml-2 text-sm text-gray-600">{{ $comentario->created_at->format('j M Y, g:i a') }}</small>
                                                                                                </div>
                                                                                            </div>
                                                                                            <p
                                                                                                class="mt-1 text-lg text-gray-900 text-break">
                                                                                                {{ $comentario->body }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @else
                                                                                <b>Sin comentarios</b>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge 
                                            @if ($ticket->estatus === 'Pendiente') text-bg-warning 
                                            @elseif($ticket->estatus === 'En proceso') text-bg-primary
                                            @elseif($ticket->estatus === 'En espera') text-bg-secondary 
                                            @elseif($ticket->estatus === 'Realizado') text-bg-success @endif">
                                                {{ $ticket->estatus }}
                                            </span>
                                        </td>
                                        {{--  ACCIONES --}}
                                        @if (Auth::user()->usertype == 'gestec' || Auth::user()->usertype == 'usuario' || Auth::user()->usertype == 'encargado')
                                            <td>
                                                <a href="{{ route('tickets.show', $ticket->id) }}"
                                                    class="btn btn-outline-secondary" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Ver Ticket">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-eye-fill"
                                                        viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                        <path
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                    </svg>
                                                </a>

                                                {{-- BUTTON AUTO ASIGNAR --}}
                                                @if (Auth::user()->usertype !== 'salaDeListas' && Auth::user()->usertype !== 'gestec')
                                                    <button type="button" class="btn btn-outline-primary ml-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#asignarModal{{ $loop->iteration }}">
                                                        {{--   para hacer funcionar un modal y un tooltip nos ayudamos de un spa --}}
                                                        <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Tomar Ticket">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-person-walking" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M9.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0M6.44 3.752A.75.75 0 0 1 7 3.5h1.445c.742 0 1.32.643 1.243 1.38l-.43 4.083a1.8 1.8 0 0 1-.088.395l-.318.906.213.242a.8.8 0 0 1 .114.175l2 4.25a.75.75 0 1 1-1.357.638l-1.956-4.154-1.68-1.921A.75.75 0 0 1 6 8.96l.138-2.613-.435.489-.464 2.786a.75.75 0 1 1-1.48-.246l.5-3a.75.75 0 0 1 .18-.375l2-2.25Z" />
                                                                <path
                                                                    d="M6.25 11.745v-1.418l1.204 1.375.261.524a.8.8 0 0 1-.12.231l-2.5 3.25a.75.75 0 1 1-1.19-.914zm4.22-4.215-.494-.494.205-1.843.006-.067 1.124 1.124h1.44a.75.75 0 0 1 0 1.5H11a.75.75 0 0 1-.531-.22Z" />
                                                            </svg>
                                                        </span>
                                                    </button>
                                                @endif
                                                {{-- MODAL AUTO ASIGNAR --}}
                                                <div class="modal fade" id="asignarModal{{ $loop->iteration }}"
                                                    tabindex="-1" aria-labelledby="asignarModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="asignarModalLabel{{ $loop->iteration }}">
                                                                    Confirmar
                                                                    Asignacion de ticket</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Seguro que deseas asignarte este ticket?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">No</button>
                                                                @if (isset($ticket))
                                                                    <form method="post"
                                                                        action="{{ route('ticket.autoupdate', $ticket->id) }}">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Si</button>
                                                                    </form>
                                                                @else
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                    {{--   TERMINAN ACCIONES --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center flex-column">
                        {!! $tickets->links() !!}
                    </div>
                </div>
            </div>
        </div>
        {{-- SCRIPT FILTRO USUARIO --}}
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
                $('.js-example-basic-single').on('change', function() {
                    /* alert(this.value) */
                    @this.set('userSelect', this.value);
                });
            });
        </script>
        {{-- SCRIPT FILTRO FOLIO --}}
        <script>
            $(document).ready(function() {
                $('#filtroFolio').select2();
                $('#filtroFolio').on('change', function() {
                    /* alert(this.value) */
                    @this.set('folio', this.value);
                });
            });
        </script>
        {{-- SCRIPT RESIZE --}}
        <script>
            $(document).ready(function() {
                function initSelect2() {
                    $('.js-example-basic-single').select2();
                }
                initSelect2();
                $(window).on('resize', function() {
                    initSelect2();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                function initSelect2() {
                    $('#filtroFolio').select2();
                }
                initSelect2();
                $(window).on('resize', function() {
                    initSelect2();
                });
            });
        </script>
    </div>

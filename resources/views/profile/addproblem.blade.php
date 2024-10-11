{{-- AGREGAR PROBLEMATICA --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Problematica') }}
        </h2>
    </x-slot>

    <section class="bg-light py-3 py-md-5">
        <div class="container">

            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <p class="mb-7 display-5 text-center f">Agrega una problemática nueva</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-12 col-lg-9">
                    <a href="{{ route('tickets.index') }}" 
                        class="mr-2 flex items-center link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                            <p class="ml-2">Regresar</p>
                    </a>
                    <div class="bg-white border rounded shadow-sm overflow-hidden mt-2">
                        <form action="{{ route('problem.store') }}" method="POST"
                            onsubmit="problematica.disable = true; return true;">
                            @csrf
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="nombre" placeholder="Escribe la problematica nueva" name="nombre" required></textarea>
                                        <label for="nombre">Problemática</label>
                                        @error('nombre')
                                                <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary"
                                            name="problematica">Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container">
                            <div class="row justify-content-start">
                            </div>
                        </div>
                        {{-- TABLA HEADER --}}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Problemáticas</th>
                                        <th scope="col" colspan="2" class="flex d-flex justify-content-center">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                {{-- TABLA CONTENIDO --}}
                                <tbody>
                                    @foreach ($problematicas as $problematica)
                                        <tr>
                                            <td>{{ $problematica->nombre }}</td>
                                            <td class="flex d-flex justify-content-center">
                                                {{-- BUTTON EDITAR --}}
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editarModal{{ $loop->iteration }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                                        height="15" fill="currentColor" class="bi bi-pencil-square"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                                                        </path>
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                {{-- MODAL EDITAR --}}
                                                <div class="modal fade" id="editarModal{{ $loop->iteration }}"
                                                    tabindex="-1"
                                                    aria-labelledby="editarModalLabel{{ $loop->iteration }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="editarModalLabel{{ $loop->iteration }}">
                                                                    Editar problemática</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <form
                                                                        action="{{ route('problem.update', $problematica->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Problemática</label>
                                                                        <input type="nombre" name="nombre"
                                                                            class="form-control"
                                                                            value="{{ $problematica->nombre }}">

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>

                                                                <button type="submit"
                                                                    class="btn btn-primary">Confirmar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- BUTTON ELIMINAR --}}
                                                <button type="button" class="btn btn-outline-danger ml-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#eliminarModal{{ $loop->iteration }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5">
                                                        </path>
                                                    </svg>
                                                </button>
                                                {{-- MODAL CONFIRMACIÓN --}}
                                                <div class="modal fade" id="eliminarModal{{ $loop->iteration }}"
                                                    tabindex="-1"
                                                    aria-labelledby="eliminarModalLabel{{ $loop->iteration }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="eliminarModalLabel{{ $loop->iteration }}">
                                                                    Confirmar eliminar problemática</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Seguro que deseas eliminar la problemática
                                                                <b>{{ $problematica->nombre }}</b>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">No</button>
                                                                <form
                                                                    action="{{ route('problem.delete', $problematica->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Si</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

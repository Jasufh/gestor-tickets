{{-- AGREGAR TICKET INTERNO --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Ticket') }}
        </h2>
    </x-slot>
    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="mb-4 display-5 text-center">Ticket</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-12 col-lg-9">
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
                    <div class="bg-white border rounded shadow-sm overflow-hidden">
                        <form action="{{ route('tickets.store') }}" method="POST"
                            onsubmit="myButton.disable = true; return true;">
                            @csrf
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <label for="edificio" class="mb-3"><b>Edificio<span style="color: red">*</span></b></label>
                                    <div class="form-floating mb-3">
                                        <select class="js-example-basic-single form-select" id="edificio"
                                            name="edificio" aria-label="Selecciona el edificio" required>
                                            <option value='' selected>Selecciona un edificio</option>
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
                                        @error('edificio')
                                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label for="edificio" class="mb-3"><b>Aula<span style="color: red">*</span></b></label>
                                    <div class="form-floating mb-3">
                                        <select class="js-example-basic-single form-select" name="aula"
                                            aria-label="Selecciona el aula" required>
                                            <option value='' selected>Selecciona un aula</option>
                                            <option value="101">101</option>
                                            <option value='102'>102</option>
                                            <option value='103'>103</option>
                                            <option value='104'>104</option>
                                            <option value='105'>105</option>
                                            <option value='106'>106</option>
                                            <option value='107'>107</option>
                                            <option value='108'>108</option>
                                            <option value='109'>109</option>
                                            <option value='201'>201</option>
                                            <option value='202'>202</option>
                                            <option value='203'>203</option>
                                            <option value='204'>204</option>
                                            <option value='205'>205</option>
                                            <option value='206'>206</option>
                                            <option value='207'>207</option>
                                            <option value='208'>208</option>
                                            <option value='209'>209</option>
                                            <option value='301'>301</option>
                                            <option value='302'>302</option>
                                            <option value='303'>303</option>
                                            <option value='304'>304</option>
                                            <option value='305'>305</option>
                                            <option value='306'>306</option>
                                            <option value='307'>307</option>
                                            <option value='308'>308</option>
                                            <option value='309'>309</option>
                                        </select>
                                        @error('aula')
                                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    {{-- ASIGANAR TIKCET A USUARIO --}}
                                    @if (Auth::user()->usertype == 'encargado' || Auth::user()->usertype == 'gestec' || Auth::user()->usertype == 'usuario')
                                    <label for="edificio" class="mb-3"><b>Asigna usuario a ticket</b></label>
                                        <div class="form-floating mb-3">
                                            <x-select2-usuarios name="user_id" :users="$users"
                                                class="rounded-3 w-100">Asignar usuario a
                                                ticket</x-select2-usuarios>
                                            @error('user_id')
                                                <p class="ms-2 mt-1 text-start text-danger">Selecciona un usuario</p>
                                            @enderror
                                </div>
                                @endif
                                <label for="edificio" class="mb-3"><b>Problematica<span style="color: red">*</span></b></label>
                                <div class="form-floating mb-3">
                                    <select class="js-example-basic-single form-select" name="problematica"
                                        placeholder="Problemática" id="problematica"
                                        aria-label="Selecciona la problematica" required>
                                        <option value='' selected>Selecciona la problematica</option>
                                        @foreach ($problematicas as $problematica)
                                            <option value="{{ $problematica->nombre }}">{{ $problematica->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('problematica')
                                        <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <label for="edificio" class="mb-3"><b>Detalles<span style="color: red">*</span></b></label>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="detalles" placeholder="Detalles de problema" name="detalles" required></textarea>
                                    <label for="detalles">Detalles de problema</label>
                                    @error('detalles')
                                        <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="myButton">Enviar</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            function initSelect2() {
                $('.js-example-basic-single').select2();
            }
            initSelect2();
        });
    </script>
</x-app-layout>

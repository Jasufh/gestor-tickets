{{-- FORMULARIO PRINCIPAL --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGA</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.css') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @include('sweetalert::alert')
    <nav class="navbar navbar-white bg-white">
        <div class="w-100 d-flex justify-content-evenly">
            <img src="{{ asset('images/CUCEA-UDG.svg') }}" alt="CUCEA-UDG" width="200">
            <img src="{{ asset('images/CTA-B.svg') }}" alt="CUCEA-UDG" width="90">
        </div>
    </nav>
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
                    <div class="bg-white border rounded shadow-sm overflow-hidden">
                        <form action="{{ route('tickets.storeMaestro') }}" method="POST" onsubmit="myButton.disable = true; return true;">
                            @csrf
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <label class="control-label mb-3"><b>Edificio <span style="color: red">*</span> </b></label>
                                    <div class="form-floating mb-3">
                                        <select class="js-example-basic-single form-select" id="edificio"
                                            name="edificio" aria-label="Selecciona el edificio" required>
                                            <option value='' selected>Selecciona un edificio</option>
                                            <option value='A'>A</option>
                                            <option value='B'>B</option>
                                            <option value='C'>C</option>
                                            <option value='D'>D</option>
                                            <option value='E'>E</option>
                                            <option value='F'>F</option>
                                            <option value='G'>G</option>
                                            <option value='H'>H</option>
                                            <option value='I'>I</option>
                                            <option value='J'>J</option>
                                            <option value='K'>K</option>
                                            <option value='L'>L</option>
                                            <option value='M'>M</option>
                                            <option value='N'>N</option>
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
                                    <label for="edificio" class="mb-3"><b>Problemática<span style="color: red">*</span></b></label>
                                    <div class="form-floating mb-3">
                                        <select class="js-example-basic-single form-select" name="problematica"  placeholder="Problemática" id="problematica"
                                            aria-label="Selecciona la problematica" required>
                                            <option value='' selected>Selecciona la problematica</option>
                                            @foreach ($problematicas as $problematica)
                                                <option value="{{ $problematica->nombre }}">{{ $problematica->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('problematica')
                                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label for="edificio" class="mb-2"><b>Detalles<span style="color: red">*</span></b></label>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="detalles" placeholder="Detalles de problema"
                                            name="detalles" required></textarea>
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
                    <div class="text-center mt-3">
                       {{--  <i class="bi bi-qr-code">{!! QrCode::size(150)->generate(route(('welcome'))) !!}</i> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        $(window).on('resize', function() {
            initSelect2();
        });
    });
</script>

</body>
{{-- <footer style="background-color: #020305;">
    <div class="container p-5">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-6 mt-3 mb-3 pe-5" style="color: white">
                    <a href="http://udg.mx"><img class="mb-3" src="https://vive.cucea.udg.mx/images/LogoCUCEA.png"
                            alt="Universidad de Guadalajara" height="60px"></a>
                    <p><a href="http://www.cucea.udg.mx/">Centro Universitario de Ciencias Económico
                            Administrativas</a></p>
                    <p>Periférico Norte N° 799, Núcleo Universitario Los Belenes, C.P. 45100, Zapopan, Jalisco,
                        México. Teléfono: +52 (33) 3770 3300.</p>
                </div>

                <div class="col-12 col-md-3 mt-3 mb-3 pe-5 d-flex align-items-center">
                    <div class="d-flex flex-column align-items-start align-items-md-end">
                        <img src="https://vive.cucea.udg.mx/images/SmartCampusBlanco.png" height="100px" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> --}}

<div>
    <!-- Footer -->
    <footer class="text-center text-white mt-5 p-5" style="background-color: #001b34;">
        <div class="row rowedit">

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ps-4 pt-4 pb-4 pe-4 cont-center" style="padding-left: 0px !important;">
                <a target="_blank" href="https://www.cucea.udg.mx/"><img style="width:40%" class="img-fluid" src="https://vive.cucea.udg.mx/images/LogoCUCEA.png" alt=""></a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="">
                    <p class="d-flex justify-content-center align-items-center">
                    </p><p>Centro Universitario de Ciencias Económico Administrativas</p>
                    <p>Periférico Norte N° 799, Núcleo Universitario Los Belenes, C.P. 45100, Zapopan, Jalisco,
                        México.</p>
                    <p>33 3770 3300 Ext. 25044</p>
                    <p></p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 cont-center">
                <img style="width:25%" class="img-fluid" src="https://ventanillaescolar.cucea.udg.mx/assets/images/app/logos/logo-smart-campus-w.png" alt="">
            </div>
        </div>
    </footer>
    <!-- Footer -->
</div>
</html>
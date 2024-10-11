{{-- AGREGAR USUARIO --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar usuario') }}
        </h2>
    </x-slot>
    <form action="{{ route('profile.store') }}" method="POST">
        @csrf
        <div class="d-lg-flex justify-content-center">
            <div class="card text-center p-lg-5 m-lg-5 mt-3 col-lg-7">
                <div class="card-body mx-lg-5 px-lg-5">
                    <label for="edificio" class="mb-3  d-flex justify content start"><b>Nombre<span
                                style="color: red">*</span></b></label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" name="name" placeholder="Nombre"
                            value="{{ old('name') }}">
                        <label for="name">Nombre</label>
                        @error('name')
                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <label for="edificio" class="mb-3  d-flex justify content start"><b>Apellidos<span
                                style="color: red">*</span></b></label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" name="apellidos" placeholder="apellidos"
                            value="{{ old('apellidos') }}" required>
                        <label for="apellidos">Apellidos</label>
                        @error('apellidos')
                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <label for="edificio" class="mb-3  d-flex justify content start"><b>Correo<span
                                style="color: red">*</span></b></label>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" name="email" placeholder="Correo"
                            value="{{ old('email') }}" required>
                        <label for="apellidos">Correo</label>
                        @error('email')
                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <label for="edificio" class="mb-3  d-flex justify content start"><b>Contraseña<span
                                style="color: red">*</span></b></label>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" name="password" placeholder="Correo"
                            required>
                        <label for="apellidos">Contraseña</label>
                        @error('password')
                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <label for="edificio" class="mb-3  d-flex justify content start"><b>Confirmar Contraseña<span
                                style="color: red">*</span></b></label>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" name="password_confirmation"
                            placeholder="Confirmar Contraseña" required>
                        <label for="apellidos">Confirmar contraseña</label>
                        @error('password_confirmation')
                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                        @enderror
                        {{-- </div>
                        <div>
                        <select class="form-select rounded-3" aria-label="Default select example" name="usertype">
                            <option disabled selected value="null">Selecciona el tipo de usuario</option>
                            <option value="usuario">usuario</option>
                        </select>
                        @error('usertype')
                            <p class="ms-2 mt-1 text-start text-danger">{{ $message }}</p>
                        @enderror
                    </div> --}}
                        <button type="submit" class="btn btn-primary mt-3 rounded-3">Agregar</button>
                    </div>
                </div>
            </div>
    </form>
</x-app-layout>

{{-- VISTA FILTRO PERO SE ENCUENTRA EN LIVEWIRE --}}
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tickets') }}
            </h2>
            <button class="btn btn-outline-primary btn-sm d-flex align-items-center" type="button"
                onclick="window.location.href = '{{ route('profile.addticket') }}'">
                Crear Ticket
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"
                    style="margin-left: 4px;">
                    <path
                        d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0Zm1.062 4.312a1 1 0 1 0-2 0v2.75h-2.75a1 1 0 0 0 0 2h2.75v2.75a1 1 0 1 0 2 0v-2.75h2.75a1 1 0 1 0 0-2h-2.75Z"
                        fill="currentColor"></path>
                </svg>
            </button>
        </div>

    </x-slot>

    @livewire('filtro')
</x-app-layout>

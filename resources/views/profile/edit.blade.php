{{-- EDITAR PERFIL --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <a href="{{ route('tickets.index') }}"
                class="mr-2 flex items-center link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
                <span class="ml-2">Regresar</span>
            </a>
            @if (Auth::user()->usertype == 'usuario')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900 mb-2">
                            {{ __('Progreso') }}
                        </h2>
                    </div>
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
                    @php
                        if ($totalTickets > 0) {
                        /*     $totalTickets = 1;
                            $progreso = 0; */
                        $progreso = ($ticketsRealizados * 100) / $totalTickets;
                        }else {
                            $totalTickets =0;
                            $progreso = 0;
                        }
                    @endphp
                    <div class="progress" role="progressbar" aria-label="succes" aria-valuenow="100" aria-valuemin="0"
                        aria-valuemax="100">
                        <div class="progress-bar bg-success " style="width:{{ $progreso }}%">
                            {{ number_format($progreso, 0) }}%</div>
                    </div>
                    <p class="mb-1 mt-1">Tickets Asignados: <span> <b> {{ $totalTickets }}</b></span></p>
                    <p class="mb-1">Tickets Realizados: <span><b>{{ $ticketsRealizados }}</b></span></p>
                </div>
            @endif
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            @if (Auth::user()->usertype == 'encargado')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

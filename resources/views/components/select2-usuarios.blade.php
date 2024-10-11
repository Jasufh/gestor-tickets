    <select wire:model.live='{{ $name }}'
    {!! $attributes->merge(['class' => 'js-example-basic-single form-select ']) !!}
        name="{{$name }}" >
        <option value="" selected>{{ $slot }}</option>
        @foreach ($users as $user)
        @if ( $user->usertype == 'gestec' || $user->usertype  == 'usuario')
        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->apellidos }}</option>
        @else
        @endif
    @endforeach
    </select>

            {{-- Asginar ticket  <div class="form-floating mb-3">
                                        <select class="js-example-basic-single form-select"
                                            aria-label="Selecciona el usuario" id="asignar-select" name="user_id">
                                            <option value="">Asigna usuario a ticket</option>
                                            @foreach ($users as $user)
                                                @if ($user->usertype == 'usuario')
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select> --}}
                                        {{--  </div> --}}
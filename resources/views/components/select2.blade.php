<select {{-- wire:model.live='$name'  --}}
{!! $attributes->merge(['class' => 'rounded-3 js-example-basic-single']) !!}>
{{ $slot }}
</select>
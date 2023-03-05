@props(['disabled' => false])
<div>
    <!-- app/view/components/forms/inputSelect.php -->
    <!-- views/components/forms/input-select.blade.php -->
    @if ($label)
    <label for="{{ $idName }}" class="text-sm">{{ $label }}</label>
    @endif

    <select wire:model="{{ $idName }}" {{ $attributes->merge(['class' => 'text-xs mx-2 my-2 rounded-md']) }}>
        <!-- <option value="" disabled>{{ __('Select...') }}</option> -->
        @foreach ($opciones as $key => $option)
        <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
    <x-input-error for="{{ $idName }}" />
</div>
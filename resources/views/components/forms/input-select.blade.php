<!-- app/view/components/forms/inputSelect.php -->
<!-- views/components/forms/input-select.blade.php -->
@props(['disabled' => false, 'label' => ''])
<div>
    @if ($label)
        <label for="{{ $idName }}" class="text-sm">{{ $label }}</label>
    @endif

    <select wire:model="{{ $idName }}" {{ $attributes->merge(['class' => 'text-xs mx-2 my-2 rounded-md']) }}>
        <option value="" disabled>{{ __('Select...') }}</option>
        @foreach ($options as $key => $option)
            <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
    <x-input-error for="{{ $idName }}" />
</div>

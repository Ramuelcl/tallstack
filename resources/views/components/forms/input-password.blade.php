@props(['disabled' => false])

<div class="mr-1 mb-3">
    <div>
        @if ($label)
        <label for="{{ $idName }}" class="block text-sm font-medium text-gray-700 dark:text-gray-50">{{ $label }}</label>
        @endif
        <div class="mt-1 relative rounded-md shadow-sm inline">
            <input wire:model="{{ $idName }}" type="{{ $type }}" name="{{ $idName }}" id="{{ $idName }}" placeholder="{{ $placeholder }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-1 sm:text-sm border-gray-300 rounded-md text-gray-700 dark:text-gray-50']) }}>
            <button wire:click="cambiaEstado()">
                @if ($type == 'password')
                <i class="fa-solid fa-eye-slash"></i>
                @else
                <i class="fa-solid fa-eye"></i>
                @endif
            </button>
        </div>
        <x-input-errors idName="{{ $idName }}"></x-input-errors>
    </div>
</div>
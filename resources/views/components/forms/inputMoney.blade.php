@props(['disabled' => false])

<div class="mr-1 mb-3">
    <div>
        @if ($label)
            <label for="{{ $idName }}"
                class="block text-sm font-medium text-gray-700 dark:text-gray-50">{{ $label }}</label>
        @endif
        <div>
            <input type="text" name="{{ $idName }}" id="{{ $idName }}"
                class="rounded-md shadow-md focus:ring-indigo-500 focus:border-indigo-500 text-right" placeholder="0.00"
                {{ $disabled ? 'disabled' : '' }}>
        </div>
        <x-input-errors idName="{{ $idName }}"></x-input-errors>
    </div>
</div>

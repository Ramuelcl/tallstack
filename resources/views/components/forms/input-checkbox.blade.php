@props(['disabled' => false])

<div class="mr-1 mb-3">
    <div class="block-inline">
        @if ($label)
        <label for="{{$idName}}" class="block text-sm font-medium text-gray-700">{{$label}}</label>
        @endif
        <div class="mt-1 relative rounded-md shadow-sm">
            <input wire:model="{{$idName}}" type="checkbox" name="{{$idName}}" id="{{$idName}}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' =>'focus:ring-indigo-500 focus:border-indigo-500 block pl-1 pr-12 sm:text-sm border-gray-300 rounded-md',]) }}>
        </div>
        <x-input-error for="{{$idName}}" />
    </div>
</div>
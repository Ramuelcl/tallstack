@props(['disabled' => false])
@isset($label)
    <label for="{{ $idName }}" class="block text-sm font-medium">
        {{ $label }}
    </label>
@endisset
<input type="{{ $tipo }}" placeholder="{{ $placeholder }}" id="{{ $idName }}" {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
]) !!}>

@props(['tipo' => 'info'])
@php
switch ($tipo) {
case 'danger':
$clase1 = 'bg-red-500 text-white font-bold rounded-t px-4 py-2';
$clase2 = 'bg-red-100 text-blue font-italic rounded-b px-4 py-2 border border-b border-red-500';
break;
case 'warning':
$clase1 = 'bg-yellow-500 text-white font-bold rounded-t px-4 py-2';
$clase2 = 'bg-yellow-100 text-yellow font-italic rounded-b px-4 py-2 border border-b border-yellow-500';
break;
default:
// info
$clase1 = 'bg-green-500 text-white font-bold rounded-t px-4 py-2';
$clase2 = 'bg-green-100 text-green font-italic rounded-b px-4 py-2 border border-b border-green-500';
break;
}
$titulo = $titulo ?? 'Atención';
@endphp
<div role="alert">

    <div class="{{ $clase1 }}">
        {{ $titulo ?? null }}
    </div>

    <div {{ $attributes->merge(['class' => "$clase2"]) }}>
        {{ $slot ?? null }}
    </div>
</div>

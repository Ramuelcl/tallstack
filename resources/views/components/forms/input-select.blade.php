{{-- @props(['disabled' => false]) --}}
<div>
    <!-- app/view/components/forms/inputSelect.php -->
    <!-- views/components/forms/input-select.blade.php -->
    @if ($label)
    <label for="{{ $idName }}">{{ $label }}</label>
    @endif

    <select wire:model="{{ $idName }} multiple" class="block w-full rounded-md focus:ring-indigo-500 focus:border-indigo-500">
        <!-- <option value="" disabled>{{ __('Select...') }}</option> -->
        @foreach ($opciones as $key => $option)
        @php
        dump([$option, array_values($selecionadas)]);
        // if (in_array($option, $selecionadas)) {
        // }
        $selected = in_array($option, $selecionadas) ? 'selected' : '';
        if ($key === 0) {
        echo "<option value='' selected>$option</option>";
        } else {
        echo "<option value='$key' $selected>$option</option>";
        }
        @endphp
        @endforeach
    </select>
    <x-input-errors idName="{{ $idName }}"></x-input-errors>
</div>
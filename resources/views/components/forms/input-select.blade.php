{{-- @props(['disabled' => false]) --}}
<div>
    <!-- app/view/components/forms/inputSelect.php -->
    <!-- views/components/forms/input-select.blade.php -->
    @if ($label)
    <label for="{{ $idName }}">{{ $label }}</label>
    @endif

    <select wire:model="{{ $idName }}" class="block w-full rounded-md focus:ring-indigo-500 focus:border-indigo-500" multiple>
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

    <select class="mt-1 rounded-md shadow-sm appearance-none block w-full px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" wire:model="{{ $idName }}" wire:change="{{ $idName }}">
        @foreach($categories as $id => $name)
        <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    </select>

    <x-input-errors idName="{{ $idName }}"></x-input-errors>
</div>
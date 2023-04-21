<div>
    {{-- resources/views/livewire/backend/liveuserindex.blade.php
        app/Http/Livewire/backend/Liveuserindex.php --}}
    {{-- // --}}
    {{ $sortField }} - {{ $sortDir }}
    {{-- // --}}
    <div class="flex justify-between">
        <div class="text-2xl">{{ $title }}</div>
        <button type="submit" wire:click="$emitTo('liveusermodal', 'showForm', null);" class="font-semibold">
            <i class="pr-6 fa-solid fa-plus"></i>
        </button>
    </div>
    <div class="flex justify-between">
        <div class="flex items-center justify-between px-4 py-1 text-xs text-gray-800 dark:text-gray-500 sm:px-2">
            <div>
                <select wire:model="collectionView" class="rounded-md text-xs">
                    @foreach ($collectionViews as $collectionView)
                        <option value="{{ $collectionView }}">{{ $collectionView }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- <x-forms.input-select idName="collectionView" :opciones="$collectionViews" :seleccionada="$collectionView" /> --}}
        @livewire('live-search', ['fields' => $nameSearch]) {{-- <livewire:live-search :fields="$nameSearch" /> --}}
    </div>
    <x-forms.table>
        <x-slot name="titles">
            <tr>
                @foreach ($fields as $field)
                    @if ($field['table']['display'])
                        @php
                            // valida el campo a ordenar; si existe le pone cursor-pointer
                            $orden = in_array($field['name'], $fieldsOrden) ? 'cursor-pointer' : '';
                            $uppercase = $field['name'] == $sortField ? 'uppercase' : 'capitalize';
                        @endphp

                        @if ($field['name'] == 'id')
                            <th wire:click="sortable('id')" scope="col"
                                class="{{ $orden }} {{ $uppercase }} justify-between px-6 py-3 bg-gray-50 text-gray-500 tracking-wide text-center text-xs font-medium">
                                Id
                                <x-forms.sort-icon campo="{{ $field['name'] }}" :sortDir="$sortDir" :sortField="$sortField" />

                            </th>
                        @elseif ($field['name'] == 'name')
                            <th wire:click="sortable('name')" scope="col"
                                class="{{ $orden }} {{ $uppercase }} justify-between px-6 py-3 bg-gray-50 text-gray-500 tracking-wide text-center text-xs font-medium">
                                nombre
                                <x-forms.sort-icon campo="{{ $field['name'] }}" :sortDir="$sortDir" :sortField="$sortField" />

                            </th>
                        @elseif ($field['name'] == 'email')
                            <th wire:click="sortable('email')" scope="col"
                                class="{{ $orden }} {{ $uppercase }} justify-between px-6 py-3 bg-gray-50 text-gray-500 tracking-wide text-center text-xs font-medium">
                                email
                                <x-forms.sort-icon campo="{{ $field['name'] }}" :sortDir="$sortDir" :sortField="$sortField" />

                            </th>
                        @elseif ($field['name'] == 'is_active')
                            <div>
                                <th scope="col"
                                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                                    @if (!$checkitAll)
                                        {{ __($field['table']['titre']) }}
                                    @endif
                                </th>
                            </div>
                        @elseif ($field['name'] == 'role')
                            <th wire:click="sortable('role')" scope="col"
                                class="{{ $orden }} {{ $uppercase }} justify-between px-6 py-3 bg-gray-50 text-gray-500 tracking-wide text-center text-xs font-medium">
                                Role
                                <x-forms.sort-icon campo="{{ $field['name'] }}" :sortDir="$sortDir" :sortField="$sortField" />

                            </th>
                        @else
                            <div>
                                <th wire:click="sortable($this->field['name'])" scope="col"
                                    class="{{ $orden }} bg-gray-50 px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                                    {{ __($field['table']['titre']) }}
                                    <x-forms.sort-icon campo="{{ $field['name'] }}" :sortDir="$sortDir"
                                        :sortField="$sortField" />
                                </th>
                            </div>
                        @endif
                    @endif
                @endforeach
                <th class="flex justify-between px-6 py-3 col-span-2 gap-2">
                    <div>
                        {{ __('actions') }}
                        {{-- @hasanyrole('admin') --}}
                    </div>
                    <div class="justify-end">
                        <button wire:click="" class="btn btn-blue text-xs"><i class="fa-solid fa-user-plus"></i>
                            {{ __($display['new']) }}
                        </button>
                        {{-- @endhasanyrole --}}
                    </div>
                </th>
            </tr>
        </x-slot>
        @foreach ($results as $result)
            <tr class="hover:bg-blue-300 {{ $loop->index % 2 ? 'bg-gray-100' : 'bg-gray-200' }}">
                @foreach ($fields as $field)
                    @if ($field['table']['display'])
                        <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                            @switch($field['name'])
                                @case('id')
                                    <!-- // relleno de ceros -->
                                    {{ sprintf('%04d', $result->id) }}
                                    <!-- // formato con decimales -->
                                    <!--  number_format($key + 1, 0, ',', '.') -->
                                @break

                                @case('profile_photo_path')
                                    @if (substr($result->profile_photo_path, 0, 8) == 'https://')
                                        <img class="h-10 w-10 rounded-full" src="{{ $result->profile_photo_path }}"
                                            alt="avatar">
                                    @else
                                        <img class="h-10 w-10 rounded-full" src="{{ asset($result->profile_photo_path) }}"
                                            alt="avatar">
                                    @endif
                                @break

                                @case('name')
                                    {{ $result->name }}
                                @break

                                @case('role')
                                    {{ implode(', ', $result->getRoleNames()->toArray()) }}
                                @break

                                @case('email')
                                    {{ $result->email }}
                                @break

                                @case('is_active')
                                    @if (!$checkitAll)
                                        <x-forms.comp-estado valor="{{ $result->is_active }}" tipo="si-no" />
                                    @endif
                                @break

                                @default
                                    Default case...
                                @break
                            @endswitch
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        @empty($results)
            {{ __('No records') }}
        @endempty
        <x-slot name="foot">

        </x-slot>
    </x-forms.table>
    @isset($results)
        <div class="flex justify-between items-center px-4 py-1 text-xs text-gray-800 dark:text-gray-500 sm:px-2">
            <div>
                <select wire:model="collectionView" class="rounded-md text-xs">
                    @foreach ($collectionViews as $collectionView)
                        <option value="{{ $collectionView }}">{{ $collectionView }}</option>
                    @endforeach
                </select>
            </div>
            <div class="justify-self-auto">
                {{ $results->links() }}
            </div>
        </div>
    @endisset
    @livewire('backend.liveusermodal')
</div>

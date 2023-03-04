<div>
    <div class="m-auto flex justify-evenly overflow-hidden border border-gray-200 align-middle text-gray-500 shadow">
        @if ($regs)
            <select wire:model="collectionView" class="rounded-md text-xs my-2">
                @foreach ($collectionViews as $collectionView)
                    <option value="{{ $collectionView }}">{{ $collectionView }}</option>
                @endforeach
            </select>

            {{-- {{ $search }} --}}
            @if ($bSearch)
                @livewire('live-search', [$nameOrden])
            @endif

            {{-- {{ $roles }} --}}
            @if ($bRoles)
                <select wire:model="roles" class="rounded-md text-xs my-2">
                    <option value="">{{ __('Selection') }}</option>
                    @foreach ($rols as $rol)
                        <option value="{{ $rol }}">{{ $rol }}</option>
                    @endforeach
                </select>

            @endif

            {{-- {{ $activo }} --}}
            @if ($bActive)
                <x-forms.input-checkbox idName="activeAll" label="Actives" class="mr-2" />
            @endif
            @if ($bSearch || $bActive)
                <button wire:click="fncClear()" class="btn btn-green text-xs"><i
                        class="fa-solid fa-eraser"></i>{{ __($display['clear']) }}</button>
            @endif
        @endif
    </div>

    <x-forms.table caption="Usuarios">
        <x-slot name="titles">
            <tr>
                @foreach ($fields as $field)
                    @if ($field['table']['display'])
                        @php
                            // valida el campo a ordenar; si existe le pone cursor-pointer
                            $orden = in_array($field['name'], $fieldsOrden) ? $field['name'] : null;
                        @endphp
                        @if ($field['name'] == 'is_active')
                            <th scope="col"
                                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                                @if (!$activeAll)
                                    {{ __($field['table']['titre']) }}
                                @endif
                            </th>
                        @else
                            <th wire:click="fncOrden('{{ $orden }}')" scope="col"
                                class="{{ $orden ? 'cursor-pointer' : '' }} bg-gray-50 px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500">
                                {{ __($field['table']['titre']) }}
                                <x-forms.sort-icon campo="{{ $field['name'] }}" :sortDir="$sortDir" :sortField="$sortField" />
                            </th>
                        @endif
                    @endif
                @endforeach
                <th class="flex justify-between px-6 py-3 col-span-2 gap-2">
                    <div>
                        {{ __('actions') }}
                        {{-- @hasanyrole('admin') --}}
                    </div>
                    <div class="justify-end">
                        <button wire:click="fncNewEdit(0)" class="btn btn-blue text-xs"><i
                                class="fa-solid fa-user-plus"></i>
                            {{ __($display['new']) }}
                        </button>
                        {{-- @endhasanyrole --}}
                    </div>
                </th>
            </tr>
        </x-slot>
        @foreach ($regs as $key => $reg)
            @php
                $cl = ($key + 1) % 2 === 0 ? '50' : '400';
            @endphp
            <tr
                class="bg-gray-{{ $cl }} dark:bg-gray-{{ $cl == '50' ? $cl + 450 : $cl + 400 }} border-b hover:bg-gray-300 dark:border-gray-700 dark:hover:bg-gray-600">
                @foreach ($fields as $field)
                    @if ($field['table']['display'])
                        <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                            @switch($field['name'])
                                @case('id')
                                    <!-- // relleno de ceros -->
                                    {{ sprintf('%04d', $reg->id) }}
                                    <!-- // formato con decimales -->
                                    {{-- -{{ number_format($key + 1, 0, ',', '.') }} --}}
                                @break

                                @case('profile_photo_path')
                                    @if (substr($reg->profile_photo_path, 0, 8) == 'https://')
                                        <img class="h-10 w-10 rounded-full" src="{{ $reg->profile_photo_path }}"
                                            alt="avatar">
                                    @else
                                        <img class="h-10 w-10 rounded-full" src="{{ asset($reg->profile_photo_path) }}"
                                            alt="avatar">
                                    @endif
                                @break

                                @case('name')
                                    {{ $reg->name }}
                                @break

                                @case('role')
                                    {{ implode(', ', $reg->getRoleNames()->toArray()) }}
                                @break

                                @case('email')
                                    {{ $reg->email }}
                                @break

                                @case('is_active')
                                    @if (!$activeAll)
                                        <x-forms.comp-estado valor="{{ $reg->is_active }}" tipo="si-no" />
                                    @endif
                                @break

                                @default
                                    Default case...
                            @endswitch
                        </td>
                    @endif
                @endforeach
                <td class="flex px-6 py-4 col-span-2 justify-around gap-2">
                    <div>
                        {{-- @hasanyrole('admin') --}}
                        <button wire:click="fncNewEdit({{ $reg->id }})"
                            class="btn btn-green justify-between text-xs"><i class="fa-solid fa-user-pen"></i>
                            {{ __($display['edit']) }}
                        </button>
                        {{-- @endhasanyrole --}}
                    </div>
                    <div>
                        {{-- @hasanyrole('admin') --}} <button wire:click="fncDeleteConfirm({{ $reg->id }})"
                            wire:loading.attr="disabled" class="btn btn-red justify-between text-xs"><i
                                class="fa-solid fa-user-minus"></i>
                            {{ __($display['delete']) }}
                        </button>
                        {{-- @endhasanyrole --}}
                    </div>
                </td>

            </tr>
        @endforeach
        <x-slot name="foot">
            <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">Regs</td>
            <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500"></td>
            <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500"></td>
            <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">{{ $TotalRegs }}</td>
        </x-slot>
    </x-forms.table>
    @isset($regs)
        <div class="flex items-center justify-between px-4 py-1 text-xs text-gray-800 dark:text-gray-500 sm:px-2">
            <select wire:model="collectionView" class="rounded-md text-xs">
                @foreach ($collectionViews as $collectionView)
                    <option value="{{ $collectionView }}">{{ $collectionView }}</option>
                @endforeach
            </select>
            <div class="bg-gray-50">
                {{ $regs->links() }}
            </div>
        </div>
    @endisset
</div>
@push('modals')
    <!-- Add record Modal -->
    <x-dialog-modal wire:model="ModalAddEdit">
        <x-slot name="title">
            {{ isset($regs->id) ? __('Edit') : __('Add') }}
        </x-slot>

        <x-slot name="content">
            @include('livewire.backend.liveuser-new-edit')
        </x-slot>

        <x-slot name="footer">
            <button wire:click="$toggle('ModalAddEdit', false)" wire:loading.attr="disabled" class="btn btn-gray">
                {{ __('Cancel') }}
            </button>

            <button wire:click="fncSave()" wire:loading.attr="disabled" class="ml-3 btn btn-green">
                {{ __('Save') }}
            </button>
        </x-slot>
    </x-dialog-modal>
@endpush

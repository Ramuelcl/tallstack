<!-- // resources.views.components.forms.table.blade.php // -->
<!-- // app.view.components.forms.table.php // -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-gray-100 dark:bg-gray-800 border-2">
    @isset($bSearch)
    @livewire('live-search')
    @endisset
    @isset($collection)
    <div class="text-xs text-gray-800 dark:text-gray-500 px-4 py-1 flex items-center justify-between sm:px-2">
        <select wire:model="collectionView" class="text-xs rounded-md">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>

        {{ $collection->links() }}
    </div>
    @endisset
    <table class="{{ $borderCell }} w-full text-sm text-left text-gray-500 dark:text-gray-400">
        @if (isset($caption))
        <caption class="text-gray-800 dark:text-gray-100">
            {{ $caption }}
        </caption>
        @else
        <caption class="text-gray-800 dark:text-gray-100">
            Título de la tabla
        </caption>
        @endif
        @if (isset($titles))
        <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="{{ $tTitles }} {{ $tAlign }}">
                {{ $titles }}
            </tr>
        </thead>
        @else
        <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="{{ $tTitles }} {{ $tAlign }}">
                <td>Títulos de columnas</td>
            </tr>
        </thead>
        @endif
        <tbody>
            @if (isset($slot))
            {{ $slot }}
            @else
            <tr>
                <td>faltan los datos</td>
            </tr>
            @endif
        </tbody>
        @isset($foot)
        <tfoot>
            <tr class="font-semibold text-gray-900 dark:text-white">
                <th scope="row" class="px-2 py-3 text-base">Total</th>
                {{ $foot }}
            </tr>
        </tfoot>
        @endisset
    </table>
    @isset($collection)
    <div class="text-xs text-gray-800 dark:text-gray-500 px-4 py-1 flex items-center justify-between sm:px-2">
        <select wire:model="collectionView" class="text-xs rounded-md">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>

        {{ $collection->links() }}
    </div>
    @endisset
</div>
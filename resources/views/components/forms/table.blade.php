<!-- // resources.views.components.forms.table.blade.php // -->
<!-- // app.view.components.forms.table.php // -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-gray-100 dark:bg-gray-800 border-2">
    <table class="{{ $borderCell }} w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
        @if (isset($caption))
        <caption class="text-xl text-gray-800 dark:text-gray-100 py-2">
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
        <tbody class="bg-gray-100 divide-y divide-gray-200 dark:bg-gray-700">
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
            <tr class="font-semibold bg-gray-300  dark:bg-gray-600 text-gray-100 dark:text-gray-500 divide-y divide-gray-200">
                <th scope="row" class="px-2 py-1 text-base">Total</th>
                {{ $foot }}
            </tr>
        </tfoot>
        @endisset
    </table>
</div>
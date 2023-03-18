<!-- // resources.views.components.forms.table.blade.php // -->
<!-- // app.view.components.forms.table.php // -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg border-2">
    <table class="{{ $borderCell }} w-full text-sm text-left whitespace-no-wrap table-auto">
        @if (isset($caption))
            <caption class="text-xl py-2">
                {{ $caption }}
            </caption>
        @endif
        @if (isset($titles))
            <thead class="text-xs">
                <tr class="{{ $tTitles }} {{ $tAlign }}">
                    {{ $titles }}
                </tr>
            </thead>
        @else
            <thead class="text-xs">
                <tr class="{{ $tTitles }} {{ $tAlign }}">
                    <td>Títulos de columnas</td>
                </tr>
            </thead>
        @endif
        <tbody class="divide-y divide-gray-200">
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
                <tr
                    class="font-semibold bg-gray-300  dark:bg-gray-600 text-gray-100 dark:text-gray-500 divide-y divide-gray-200">
                    <th scope="row" class="px-2 py-1 text-base">Total</th>
                    {{ $foot }}
                </tr>
            </tfoot>
        @endisset
    </table>
</div>

@props(['sortDir', 'sortField', 'campo'])

@if ($sortField == $campo)
    @if ($sortDir == 'asc')
        <i class="fa-solid fa-sort-up ml-2"></i>
    @else
        <i class="fa-solid fa-sort-down ml-2"></i>
    @endif
@endif

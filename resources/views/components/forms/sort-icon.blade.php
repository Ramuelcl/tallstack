<div>
    @if ($sortField == $campo)
        @if ($sortDir == 'asc')
            <i class="fa-solid fa-sort-up ml-2"></i>
        @elseif ($sortDir == 'desc')
            <i class="fa-solid fa-sort-down ml-2"></i>
        @endif
    @endif
</div>

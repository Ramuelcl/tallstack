<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sortIcon extends Component
{
    public $campo, $sortDir, $sortField;

    /**
     * Create a new component instance.
     */
    public function __construct($campo = 'id', $sortDir = 'asc', $sortField = 'id')
    {
        $this->campo = $campo;
        $this->sortDir = $sortDir;
        $this->sortField = $sortField;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd([$this->sortField, $this->sortDir, $this->campo]);
        return view('components.forms.sort-icon');
    }
}

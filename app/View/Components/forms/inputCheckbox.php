<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class inputCheckbox extends Component
{
    public $idName, $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName,  string $label = '')
    {
        $this->idName = $idName;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-checkbox');
    }
}

<?php
// app/view/components/forms/inputSelect.php
// views/components/forms/input-select.blade.php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class inputSelect extends Component
{
    public  $idName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($idName = 'id')
    {
        $this->idName = $idName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.forms.input-select');
    }

    public function isSelected($option)
    {
        // return $option == old($this->name, $this->value) ? 'selected' : '';
    }
}

<?php
// app/view/components/forms/inputSelect.php
// views/components/forms/input-select.blade.php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class inputSelect extends Component
{
    public $idName, $label, $opciones, $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName,  string $label = '', array $opciones = [])
    {
        $this->idName = $idName;
        $this->label = $label;
        $this->opciones = array_merge(["Select..."], $opciones);
        // dd($this->opciones);
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
        return $option == old($this->idName, $this->value) ? 'selected' : '';
    }
}

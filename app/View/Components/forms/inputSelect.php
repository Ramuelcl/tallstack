<?php
// app/view/components/forms/inputSelect.php
// views/components/forms/input-select.blade.php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class inputSelect extends Component
{
    public $idName, $opciones, $seleccionada;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName,  array $opciones = [], $seleccionada = 0)
    {
        $this->idName = $idName;
        $this->opciones = array_merge(["Select..."], $opciones);
        $this->seleccionada =  $seleccionada;
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

    // public function isSelected($seleccionada)
    // {
    //     return in_array($seleccionada, $this->opciones) ? 'selected' : '';
    // }
}

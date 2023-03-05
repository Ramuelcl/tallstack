<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;
// use Livewire\WithFileUploads;

class input extends Component
{
    // use WithFileUploads;

    public $idName, $tipo, $label, $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName, string  $tipo = 'text', string $label = '', string $placeholder = '')
    {
        $this->idName = $idName;
        $this->tipo = $tipo;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}

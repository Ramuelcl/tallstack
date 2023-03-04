<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;
use Livewire\WithFileUploads;

class input extends Component
{
    use WithFileUploads;

    public $label, $placeholder, $idName, $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName, string  $type = 'text', string $label = '', string $placeholder = '')
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->idName = $idName;
        $this->type = $type;
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

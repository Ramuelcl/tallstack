<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;
use Livewire\WithFileUploads;

class fotos extends Component
{
    use WithFileUploads;

    public $label, $idName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName, string $label = '')
    {
        $this->label = $label;
        $this->idName = $idName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.fotos');
    }
}

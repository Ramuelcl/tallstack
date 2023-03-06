<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class input extends Component
{
    public $idName, $type, $label, $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $idName, string  $type = 'text', string $label = '', string $placeholder = '')
    {
        $this->idName = $idName;
        $this->type = $type;
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

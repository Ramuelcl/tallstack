<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class compModal extends Component
{
    public $showModal;
    /**
     * Create a new component instance.
     */
    public function __construct(string $showModal)
    {
        $this->showModal = $showModal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comp-modal');
    }
}

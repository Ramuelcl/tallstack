<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class rmaModal extends Component
{
    public $show = "hidden";
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public function fncShow()
    {
        $this->show = "";
    }

    public function fncHidden()
    {
        $this->show = "hidden";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rma-modal');
    }
}

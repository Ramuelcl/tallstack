<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class Liveusermodal extends Component
{
    public $showModal = true;

    public function render()
    {
        return view('livewire.backend.liveusermodal');
    }
}

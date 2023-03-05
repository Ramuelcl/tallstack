<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveModal extends Component
{
    protected $listeners = [
        'showModal'
    ];
    public $showModal = 'hidden'; // muestra u oculta el modal

    public function render()
    {
        return view('livewire.live-modal');
    }

    public function showModal($user = null)
    {
        // dd($user);
        if ($this->showModal === 'hidden')
            $this->showModal = '';
        else {
            $this->showModal = 'hidden';
        }
        // dd('abrir modal', $this->showModal);
    }
}

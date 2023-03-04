<?php
// CLASS: app/Http/Livewire//Sidebar.php
// VIEW:  C:\laragon\www\esqueleto0\resources\views/livewire/sidebar.blade.php
namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $isOpen;

    /** escuchas */
    protected $listeners = [
        // 'fncSearch',
        // 'roleUpdating' => 'render',
    ];

    public function __construct($isOpen = false)
    {
        $this->isOpen = $isOpen;
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}

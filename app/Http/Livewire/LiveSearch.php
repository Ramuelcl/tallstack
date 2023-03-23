<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveSearch extends Component
{
    public $search = '';
    public $fields;

    /** escuchas */
    protected $listeners = [
        'fncSearchClear',
        // 'roleUpdating' => 'render',
    ];

    public function __construct($fields = '')
    {
        // dd($fields);
        $this->fields =  $fields;
    }

    // public function mount($fields = ['id'])
    // {
    //     // dd($fields);
    //     if (is_null($fields) or sizeof($fields) < 1)
    //         $this->fields = '';
    //     else
    //         $this->fields = implode(', ', $fields);
    // }

    public function render()
    {
        $this->emit('Search', $this->search);
        return view('livewire.live-search');
    }

    public function fncSearchClear()
    {
        $this->reset(['search']);
        // $this->reset();
    }
}

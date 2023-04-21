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

    public function render()
    {
        // if ($this->search)
        //     dd($this->search);
        $this->emitUp('search', $this->search);
        return view('livewire.live-search');
    }

    public function fncSearchClear()
    {
        $this->reset(['search']);
        // $this->reset();
    }
}

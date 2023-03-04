<?php

namespace App\Http\Livewire\Backend;

use Livewire\{Component, WithPagination};
// use Livewire\WithPagination;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;

class LiveuserTable extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $collectionView = 5;
    public $collectionViews = array('5', '10', '25', '50');

    // titulos a mostrar
    public $display = [
        'title' => 'Usuarios',
        'caption' => 'Roles',
        'clear' => 'Clear',
        'no records' => 'No records to show',
        'created' => 'creado...',
        'edited' => 'editado...',
        'deleted' => 'borrado...',
        'new' => 'Crear',
        'save' => 'Guardar',
        'actions' => 'Acciones',
        'delete' => 'Borrar',
        'edit' => 'Editar',
        'search' => 'Buscar...',
        'actives' => 'Actives?',
    ];
    // definicion de campos
    public $fields = [
        //0
        'id' => [
            'name' => 'id',
            'input' => ['type' => 'text', 'label' => 'Id', 'display' => false, 'disabled' => true],
            'table' => ['titre' => 'id', 'display' => true, 'disabled' => true]
        ],
        //1
        'profile_photo_path' => [
            'name' => 'profile_photo_path',
            'input' => ['type' => 'text', 'label' => 'Photo', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Photo', 'display' => true, 'disabled' => false]
        ],
        //2
        'name' => [
            'name' => 'name',
            'input' => ['type' => 'text', 'label' => 'Nombre', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Nombre', 'display' => true, 'disabled' => false]
        ],
        //3
        'email' => [
            'name' => 'email',
            'input' => ['type' => 'mail', 'label' => 'eMail', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Mail', 'display' => true, 'disabled' => false]
        ],
        //4
        'is_active' => [
            'name' => 'is_active',
            'input' => ['type' => 'checkit', 'label' => 'Active ?', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Active', 'display' => true, 'disabled' => false]
        ],
    ];
    // orden y filtro
    public $sortField = 'id', $sortDir = 'Desc';
    // elemento activo
    public $bActive;
    public $activeAll = false;

    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.backend.liveuser-table', [
            'regs' => User::paginate($this->collectionView),
        ]);
    }
}

<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

use App\Models\User as Item;
use Spatie\Permission\Models\Role;
class Liveuserindex extends Component
{
    public $title = 'Usuarios';

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
    public $fields = [
        //0
        'id' => [
            'name' => 'id',
            'input' => ['type' => 'text', 'label' => 'Id', 'display' => false, 'disabled' => true],
            'table' => ['titre' => 'id', 'display' => true, 'disabled' => true],
        ],
        //1
        'profile_photo_path' => [
            'name' => 'profile_photo_path',
            'input' => ['type' => 'text', 'label' => 'Photo', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Photo', 'display' => true, 'disabled' => false],
        ],
        //2
        'name' => [
            'name' => 'name',
            'input' => ['type' => 'text', 'label' => 'Nombre', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Nombre', 'display' => true, 'disabled' => false],
        ],
        //3
        'email' => [
            'name' => 'email',
            'input' => ['type' => 'mail', 'label' => 'eMail', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Mail', 'display' => true, 'disabled' => false],
        ],
        //4
        'is_active' => [
            'name' => 'is_active',
            'input' => ['type' => 'checkit', 'label' => 'Activo ?', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Activo', 'display' => true, 'disabled' => false],
        ],
        //5
        'role' => [
            'name' => 'role',
            'input' => ['type' => 'text', 'label' => 'Rol', 'display' => true, 'disabled' => true],
            'table' => ['titre' => 'Rol', 'display' => true, 'disabled' => true],
        ],
    ];
    // elemento checkit
    public $bCheckitAll;
    public $checkitAll;
    // orden y filtro
    public $sortField = 'id',
        $sortDir = 'Desc';
    // campos por los cuales ordenar
    public $fieldsOrden = ['id', 'name', 'email'];
    public $nameOrden = ['id', 'Nombre', 'e-Mail'];

    public function render()
    {
        return view('livewire.backend.liveuserindex', [
            'results' => Item::paginate(5),
            'roles' => Role::all()
                ->pluck('name')
                ->toArray(),
        ]);
    }
}

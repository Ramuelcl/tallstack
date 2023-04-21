<?php
// resources/views/livewire/backend/liveuserindex.blade.php
// app/Http/Livewire/backend/Liveuserindex.php

namespace App\Http\Livewire\Backend;

use Livewire\{Component, WithPagination};

use App\Models\User as Item;
use Spatie\Permission\Models\Role;

class Liveuserindex extends Component
{
    use WithPagination;

    private $items;
    public $title = 'Usuarios';

    public $collectionView = 5;
    public $collectionViews = array('5', '10', '25', '50');

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
        $sortDir = 'desc', $uppercase = '';
    // campos por los cuales ordenar
    public $fieldsOrden = ['id', 'name', 'email', 'role'];
    public $nameOrden = ['id', 'Nombre', 'e-Mail', 'Role'];
    // buscar en los campos
    public $nameSearch = 'id, Nombre, e-Mail';
    public $search = '';
    protected $listeners = [
        'search' => 'fncSearch'
    ];

    public function render()
    {
        $this->updatedQuery();
        return view('livewire.backend.liveuserindex', [
            'results' => $this->items,
            'roles' => Role::all()
                ->pluck('name')
                ->toArray(),
        ]);
    }

    public function updatedQuery()
    {
        $this->items = Item::where('id', '>', 0)

            // filtrando por contenido en los campos
            ->when($this->search, function ($query) {
                $srch = "%{$this->search}%";
                return $query->where('id', 'like', $srch)
                    ->orWhere('name', 'like', $srch)
                    ->orWhere('email', 'like', $srch);
            })

            // ordenando los campos cuando no son nulos &&
            ->when($this->sortField && $this->sortDir, function ($query) {
                if ($this->sortField === 'role') {
                    return $query->orderBy(Role($query, $this->role), $this->sortDir);
                    // return $query->orderBy(Role::select('name')->whereColumn('roles.user_id', 'users.id'), $this->sortDir);
                } else {
                    return $query->orderBy($this->sortField, $this->sortDir);
                }
            })

            //muestra solo los activos
            ->when($this->checkitAll, function ($query) {
                return $query->active($query);
            });

        // paginando
        $this->items = $this->items->paginate($this->collectionView);
        $this->fncTotal();
        // $this->permisos = Permission::all();
        return;
    }

    public function fncOrden($sortField = 'id')
    {
        // dd($sortField);
        // existe en la lista de campos a ordenar
        if (!in_array($sortField, $this->fieldsOrden))
            return;

        // campo a ordenar
        $this->sortField = $sortField;
        // dd($sortField);

        // orden asc, desc, null
        switch ($this->sortDir) {
            case 'asc':
                $this->sortDir = 'desc';
                break;
            case 'desc':
                $this->sortDir = 'asc';
                break;
        }

        $this->updatedQuery();
    }

    public function sortable($sortField = 'id')
    {
        // existe en la lista de campos a ordenar
        if (!in_array($sortField, $this->fieldsOrden))
            return;

        // dd([$this->sortField, $this->sortDir]);
        // campo a ordenar
        $this->sortField = $sortField;
        // dd($sortField);

        // orden asc, desc
        switch ($this->sortDir) {
            case 'asc':
                $this->sortDir = 'desc';
                break;
            case 'desc':
                $this->sortDir = 'asc';
                break;
        }
    }

    public function fncCursor($field = 'id')
    {

        // valida el campo a ordenar; si existe le pone cursor-pointer
        return in_array($field, $this->fieldsOrden) ? 'cursor-pointer' : '';
    }

    public function fncSearch($search)
    {
        // dd($search);
        $this->search = $search;
    }

    public function fncTotal()
    {
        return Item::count();
    }
}

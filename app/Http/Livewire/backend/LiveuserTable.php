<?php

namespace App\Http\Livewire\Backend;

use Livewire\{Component, WithPagination};
// use Livewire\WithPagination;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Models\Role;

class LiveuserTable extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $Model = User::class;
    public $page = 1;

    protected $collection;
    public $collectionView = 5;
    public $collectionViews = array('5', '10', '25', '50');

    // elemento de busqueda
    public $bSearch = true;
    public $search;

    // elemento activo
    public $bActive = true;
    public $activeAll;

    // elemento roles
    public $bRoles = true;
    public $roles;

    // elemento checkit
    public $bChk;
    public $chkAll;

    // control de modales
    public $ModalAddEdit = true;
    public $ModalDelete = false;

    public $mode = null; // modo false=agregar registro, true=editar registro
    public $title; // titulo del modal


    // campos de la tabla
    public $user_id;
    public $name;
    public $email;
    public $is_active;
    public $profile_photo_path;
    public $old_photo_path;
    public $password;
    public $password_confirm;

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
            'input' => ['type' => 'checkit', 'label' => 'Activo ?', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Activo', 'display' => true, 'disabled' => false]
        ],
        //5
        'role' => [
            'name' => 'role',
            'input' => ['type' => 'text', 'label' => 'Rol', 'display' => true, 'disabled' => true],
            'table' => ['titre' => 'Rol', 'display' => true, 'disabled' => true]
        ],
    ];

    // orden y filtro
    public $sortField = 'id', $sortDir = 'Desc';
    // campos por los cuales ordenar
    public $fieldsOrden = array('id', 'name', 'email');
    public $nameOrden = array('id', 'Nombre', 'e-Mail');

    /** variables  */
    public $TotalRegs = 0;

    public $DeleteConfirm = 0;
    public $filePath = 'storage/avatars';

    /** escuchas */
    protected $listeners = [
        'Search' => 'fncSearch',
        // 'roleUpdating' => 'render',
    ];

    public function fncSearch($search)
    {
        $this->search = $search;
        // $this->render();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDir' => ['except' => 'Desc'],
    ];

    public function __construct()
    {
        // $this->Model =  User::class;
        // dd($this->Model);
    }
    public function mount()
    {
    }
    public function render()
    {
        $this->updatedQuery();
        // dd(Role::all()->pluck('id', 'name')->toArray());
        return view('livewire.backend.liveuser-table', [
            'regs' => $this->collection,
            'rols' => Role::all()->pluck('name')->toArray(),
        ]);
    }

    public function updatedQuery()
    {
        $this->collection = $this->Model::where('id', '>', 0)

            ->when($this->search, function ($query) {
                $srch = "%$this->search%";
                return $query->where('id', 'like', $srch)
                    ->orWhere('name', 'like', $srch)
                    ->orWhere('email', 'like', $srch)
                    // filtrando por un campo de otra tabla
                    // ->whereColumn('direccion.ciudad', 'like', $srch)
                ;
            })

            ->when($this->sortField || $this->sortDir, function ($query) {
                if ($this->sortField === 'field') { // campo a filtrar
                    // otro campo de otra tabla anexa
                    // return $query->orderBy(User::with('roles')->get(), $this->sortDir);
                    // otra opcion
                    // return $query->orderBy(Apellido::select('lastname')
                    // ->whereColumn('apellidos.user.id', 'users.id'), $this->sortDir);
                } else {
                    return $query->orderBy($this->sortField, $this->sortDir);
                }
            })


            ->when($this->roles, function ($query) {
                // $srch = "%$this->search%";
                // dd($this->roles);
                return $query->role($this->roles);
            })

            ->when($this->activeAll, function ($query) {
                return $query->active($query);
            });

        $this->collection = $this->collection->paginate($this->collectionView);
        $this->fncTotalRegs();
        // $this->permisos = Permission::all();
    }

    public function fncTotalRegs()
    {
        $this->TotalRegs = $this->Model::count();
    }

    public function fncClear()
    {
        // $this->page = 1;
        $this->resetErrorBag();
        $this->resetPage();
        // $this->reset(['collection', 'search', 'activeAll', 'roles', 'sortField', 'sortDir']);
        $this->reset();
        $this->emit('fncSearchClear');
    }

    public function fncOrden($sortField = 'id')
    {
        if ($sortField == null || !in_array($sortField, $this->fieldsOrden))
            return;
        // dd($sortField);
        if ($this->sortField == $sortField) {
            $this->sortDir = $this->sortDir == 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortField = $sortField;
            $this->sortDir = 'asc';
        }

        $this->updatedQuery();
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:6',
            'email' => ['required', 'email', 'not_in:' . auth()->user()->email],
        ];
    }

    public function fncNewEdit(User $user = null)
    {
        $this->emit('showModal', $user);
        // dump($user);
        // $this->mode = $user->id; // 0/false=crear registro, 1/true=editar registro
        // if ($this->mode) {
        //     $this->reset(['id', 'name', 'email', 'profile_photo_path', 'password', 'password_confirm']);
        //     $this->is_active = true;

        //     $this->title = 'Add register';
        // } else {
        //     $this->reset(['password', 'password_confirm']);
        //     $rules = [
        //         'name' => ['required', 'min:6'],
        //         'email' => ['required', 'email', 'min:7', 'unique:users,email'],
        //         'password' => [
        //             'required', 'string', 'min:6',
        //             'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'
        //         ],
        //         'password_confirm' => ['required', 'same:password'],
        //     ];

        //     $this->id = $user->id;
        //     $this->name = $user->name;
        //     $this->email = $user->email;
        //     $this->profile_photo_path = $user->profile_photo_path;
        //     $this->is_active = $user->is_active;

        //     $this->title = 'Edit register';
        // }

        // $this->resetErrorBag();

        // $this->ShowModal();
    }
    public function fncSave()
    {
        //
    }



    // getter & setter
    public function sortField(): Attribute
    {
        return new Attribute(
            get: fn () => $this->sortField,
            set: fn ($value) => $this->sortField = $value,
        );
    }

    public function sortDir(): Attribute
    {
        return new Attribute(
            get: fn () => $this->sortDir,
            set: fn ($value) => $this->sortDir = $value,
        );
    }

    public function bSearch(): Attribute
    {
        return new Attribute(
            get: fn () => $this->bSearch,
            set: fn ($value) => $this->bSearch = $value,
        );
    }

    public function bActive(): Attribute
    {
        return new Attribute(
            get: fn () => $this->bActive,
            set: fn ($value) => $this->bActive = $value,
        );
    }

    public function bChk(): Attribute
    {
        // dd('paso');
        return new Attribute(
            get: fn () => $this->bChk,
            set: fn ($value) => $this->bChk = $value,
        );
    }
}

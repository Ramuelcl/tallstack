<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Livewire\Component;
use Livewire\WithPagination;

class LiveTable extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $Model;

    protected $collection;
    public $collectionView = 5;
    public $collectionViews = array('5', '10', '25', '50');

    // elemento de busqueda
    public $bSearch;
    public $search;

    // elemento activo
    public $bActive;
    public $activeAll;

    // elemento checkit
    public $bChk;
    public $chkAll;


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
        [
            'name' => 'id',
            'input' => ['type' => 'text', 'label' => 'Id', 'display' => false, 'disabled' => true],
            'table' => ['titre' => 'id', 'display' => true, 'disabled' => true]
        ],
        //1
        [
            'name' => 'profile_photo_path',
            'input' => ['type' => 'text', 'label' => 'Photo', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Photo', 'display' => true, 'disabled' => false]
        ],
        //2
        [
            'name' => 'name',
            'input' => ['type' => 'text', 'label' => 'Nombre', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Nombre', 'display' => true, 'disabled' => false]
        ],
        //3
        [
            'name' => 'email',
            'input' => ['type' => 'mail', 'label' => 'eMail', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Mail', 'display' => true, 'disabled' => false]
        ],
        //4
        [
            'name' => 'is_active',
            'input' => ['type' => 'checkit', 'label' => 'Active ?', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Active', 'display' => true, 'disabled' => false]
        ],
    ];

    // campos por los cuales ordenar
    public $fieldsOrden = array('id', 'name', 'email');

    /** variables  */
    public $TotalRegs = 0;
    public $mode = null;
    public $showModal = 'hidden';
    public $DeleteConfirm = 0;
    public $filePath = 'public/images/avatars';

    /** escuchas */
    protected $listeners = [
        'Search' => 'fncSearch',
        // 'roleUpdating' => 'render',
    ];

    public function fncSearch($search)
    {
        // dd('llegó a live-table.blade:', $search);
        $this->search = $search;
        $this->render();
    }

    // orden y filtro
    public $sortField = 'id', $sortDir = 'Desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDir' => ['except' => 'Desc'],
    ];

    public function __construct($bSearch = true, $bActive = true)
    {
        $this->Model =  User::class;
        // dd($this->Model);

        $this->bSearch = $bSearch;
        $this->bActive = $bActive;
    }

    public function render()
    {
        $this->updatedQuery();

        return view('livewire.backend.live-table', [
            'regs' => $this->collection,
        ]);
    }
    public function updatedQuery()
    {
        $this->collection = $this->Model::where('id', '>', 0)
            ->when($this->search, function ($query) {
                $srch = "%$this->search%";
                return $query->where('id', 'like', $srch)
                    ->orWhere('name', 'like', $srch)
                    ->orWhere('email', 'like', $srch);
            })

            ->when($this->sortField || $this->sortDir, function ($query) {
                if ($this->sortField === 'edad') {
                    // return $query->orderBy(Perfil::select('edad')->whereColumn('perfiles.user_id', 'users.id'), $this->sortDir);
                } else {
                    return $query->orderBy($this->sortField, $this->sortDir);
                }
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
        $this->resetErrorBag();
        $this->resetPage();
        $this->reset(['collection', 'search', 'activeAll', 'sortField', 'sortDir']);
        // $this->reset();
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

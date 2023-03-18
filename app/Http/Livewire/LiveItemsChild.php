<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \Illuminate\View\View;
use App\Models\user;

class LiveItemsChild extends Component
{

    public $item;

    /**
     * @var array
     */
    protected $listeners = [
        'showDeleteForm',
        'showCreateForm',
        'showEditForm',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'item.name' => '',
        'item.email' => '',
        'item.password' => '',
        'item.profile_photo_path' => '',
        'item.is_active' => '',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.email' => 'Email',
        'item.password' => 'Password',
        'item.profile_photo_path' => 'Profile Photo Path',
        'item.is_active' => 'Is Active',
    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;

    /**
     * @var string | int
     */
    public $primaryKey;

    /**
     * @var bool
     */
    public $confirmingItemCreation = false;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function render(): View
    {
        return view('livewire.live-items-child');
    }

    public function showDeleteForm(int $id): void
    {
        $this->confirmingItemDeletion = true;
        $this->primaryKey = $id;
    }

    public function deleteItem(): void
    {
        user::destroy($this->primaryKey);
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->emitTo('live-items', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->validate();
        $item = user::create([
            'name' => $this->item['name'] ?? '', 
            'email' => $this->item['email'] ?? '', 
            'password' => $this->item['password'] ?? '', 
            'profile_photo_path' => $this->item['profile_photo_path'] ?? '', 
            'is_active' => $this->item['is_active'] ?? '', 
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('live-items', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(user $user): void
    {
        $this->resetErrorBag();
        $this->item = $user;
        $this->confirmingItemEdit = true;
    }

    public function editItem(): void
    {
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->emitTo('live-items', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}

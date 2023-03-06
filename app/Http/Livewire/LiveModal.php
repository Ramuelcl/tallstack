<?php

namespace App\Http\Livewire;

use App\Http\Requests\requestUser;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class LiveModal extends Component
{
    public $user = null;

    // campos de la tabla
    public $name;
    public $email;
    public $password;
    public $password_confirm;
    public $is_active;
    public $profile_photo_path;
    public $old_photo_path;

    public $title;
    public $misRoles;
    protected $listeners = [
        'showModal',

    ];
    public $showModal = 'hidden'; // muestra u oculta el modal

    public function render()
    {
        // $all_users_with_all_their_roles = User::with('roles')->get();
        $all_roles_in_database = Role::all()->pluck('name', 'id')->toArray();
        return view('livewire.live-modal', ['roles' => $all_roles_in_database]);
    }

    public function showModal(User $user = null)
    {
        // dd($user);
        $this->user = $user;
        if (is_null($user)) {
            $this->title = 'New register';
        } else {
            $this->misRoles = $user->roles()->pluck('name')->toArray();
            // dd($this->misRoles);
            $this->title = 'Edit register';

            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->profile_photo_path = $user->profile_photo_path;
            $this->is_active = $user->is_active;
        }
        $this->showModal = '';
    }
    public function closeModal()
    {
        $this->reset();
        // $this->showModal = 'hidden';
    }
    public function fncSave()
    {
        $requestUser = new requestUser();
        $values = $this->validate($requestUser->rules(), $requestUser->messages());
        $this->user->update($values);
        // cuando hay una tabla relacionada
        // $this->user->r_role()->update(['role' => $values['role']]);
        $this->emit('updateUser');
        $this->reset();
        // dd($values);
    }

    public function updated($field)
    {
        $requestUser = new requestUser();
        $this->validateOnly($field, $requestUser->rules(), $requestUser->messages());
        // dd($field);
    }
}

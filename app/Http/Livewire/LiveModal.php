<?php

namespace App\Http\Livewire;

use App\Http\Requests\requestUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class LiveModal extends Component
{
    public $user = null;

    // campos de la tabla
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $is_active;
    public $profile_photo_path;
    public $old_photo_path;

    public $title;
    public $mode = null;
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
        // dd($user->name);
        if (is_null($user->name)) {
            $this->mode = 0;
            $this->title = 'New register';
        } else {
            $this->user = $user;
            $this->mode = 1;
            $this->title = 'Edit register';
            $this->misRoles = $user->roles()->pluck('name')->toArray();
            // dd($this->misRoles);

            // $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->profile_photo_path = $user->profile_photo_path;
            $this->is_active = $user->is_active;
        }
        $this->showModal = '';
    }
    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        // $this->showModal = 'hidden';
    }
    public function fncSave()
    {
        $requestUser = new requestUser();

        $values = $this->validate($requestUser->rules($this->user), $requestUser->messages());
        if ($this->mode) {
            $this->user->update($values);
            // cuando hay una tabla relacionada
            // $this->user->r_role()->update(['role' => $values['role']]);
        } else {
            $user = new User;
            // cuando hay una tabla relacionada
            // $roles = new Role;

            $user->fill($values);
            DB::transaction(function ($user) {

                $user->save();
                // cuando hay una tabla relacionada
                // $roles->r_role()->associate($user)->save();
            });
        }
        $this->emit('updateUser');
        $this->closeModal();
        // dd($values);
    }

    public function updated($field)
    {
        $requestUser = new requestUser();
        $this->validateOnly($field, $requestUser->rules($this->user), $requestUser->messages());
        // dd($field);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class UserListItem extends Component
{
    public $user;
    public $role;
    public $roles;

    public function mount(User $user){
        $this->user = $user;
        $this->role = $user->role;
        $this->roles = Role::where('name', '!=', auth()->user()->role)->get();

    }

    public function updateUser(){
        $this->user->role = $this->role;
        $this->user->save();
    }

    public function delete(User $user){
        $user->delete();

        $this->dispatch('user_delete');
    }
    
    public function render()
    {
        return view('livewire.user-list-item');
    }
}

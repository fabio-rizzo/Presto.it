<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\Attributes\On;

class UserList extends Component
{
    //ci si salvera la query di ricerca dentro
    public $search = '';
    
    public $listItems;
    
    
    
    
    public function mount()
    {
        $this->listItems = [];
        $this->search = '';
    }
    
    //eseguito prima del rendering per esequire le assegnazioni
    
    #[on('user_delete')]
    public function render(){

        return view('livewire.user-list',[
            'users' => \app\models\User::search($this->search)->where('role', '!=', 'admin'),
        ]);
    }
}

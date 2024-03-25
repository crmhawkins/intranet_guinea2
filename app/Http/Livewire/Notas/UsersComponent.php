<?php

namespace App\Http\Livewire\Notas;

use App\Models\User;
use App\Models\Comunidad;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UsersComponent extends Component
{
    // public $search;
    public $usuarios;

    public function mount()
    {

    }

    public function render()
    {
        $this->usuarios = DB::table('users')->where('role', 2)->get();

        return view('livewire.notas.users-component');
    }

}

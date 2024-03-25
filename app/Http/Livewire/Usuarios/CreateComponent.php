<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Comunidad;
use App\Models\User;
use App\Models\Rol;
use App\Models\Club;
use App\Models\UserClub;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateComponent extends Component
{

    use LivewireAlert;

    public $name;
    public $surname;
    public $role = 2;
    public $username;
    public $despartamentos;
    public $password;
    public $email;
    public $user_department_id = 1;

    public $isAdminCheckbox = false;

    public function render()
    {
        return view('livewire.usuarios.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        if ($this->isAdminCheckbox == false) {
            $this->role = 0;
        } elseif ($this->isAdminCheckbox == true) {
            $this->role = 1;
        }


        $this->password = Hash::make($this->password);
        // Validación de datos
        $validatedData = $this->validate(
            [
                'name' => 'required',
                'surname' => 'required',
                'role' => 'required',
                'username' => 'required',
                'password' => 'required',
                'email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],

            ],
            // Mensajes de error
            [
                'name.required' => 'El nombre es obligatorio.',
                'surname.required' => 'El apellido es obligatorio.',
                'role.required' => 'El rol es obligatorio.',
                'username.required' => 'El nombre de usuario es obligatorio.',
                'password.required' => 'La contraseña es obligatoria.',
                'email.required' => 'El email es obligatorio.',
                'email.regex' => 'Introduce un email válido',
            ]
        );

        // Guardar datos validados
        $validatedData['inactive'] = 0;
        $usuariosSave = User::create($validatedData);

        // Alertas de guardado exitoso
        if ($usuariosSave) {
            $this->alert('success', '¡Usuario registrado correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información del usuario!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

    // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
            'submit'
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('usuarios.index');
    }
}

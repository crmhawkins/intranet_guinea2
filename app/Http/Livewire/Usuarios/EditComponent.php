<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Anuncio;
use App\Models\Comunidad;
use App\Models\Incidencia;
use App\Models\Seccion;
use App\Models\User;
use App\Models\UserClub;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class EditComponent extends Component
{
    use LivewireAlert;

    public $identificador;

    public $name;
    public $surname;
    public $roles = 0; // 0 por defecto por si no se selecciona ninguna
    public $comunidad;
    public $role;
    public $username;
    public $password = null;
    public $email;
    public $inactive;
    public $comunidad_nombre;
    public $comunidad_direccion;
    public $comunidad_info;
    public $comunidad_imagen;
    public $comunidad_secciones;

    public function mount()
    {
        $usuarios = User::find($this->identificador);
        $this->name = $usuarios->name;
        $this->surname = $usuarios->surname;
        $this->role = $usuarios->role;
        $this->username = $usuarios->username;
        $this->email = $usuarios->email;
        $this->inactive = $usuarios->inactive;
        // $this->comunidad = Comunidad::where('user_id', $this->identificador)->first();
        // if ($this->comunidad != null) {
        //     $this->comunidad_nombre = $this->comunidad->nombre;
        //     $this->comunidad_direccion = $this->comunidad->direccion;
        //     $this->comunidad_info = $this->comunidad->informacion_adicional;
        //     $this->comunidad_imagen = $this->comunidad->ruta_imagen;
        //     $this->comunidad_secciones = (new Seccion)->getHierarchy($this->comunidad->id);
        // }
    }

    public function render()
    {
        return view('livewire.usuarios.edit-component');
    }

    // Al hacer update en el formulario
    public function update()
    {
        $usuarios = User::find($this->identificador);

        if ($this->password == null) {
            $this->password = $usuarios->password;
        }else{
            $this->password = Hash::make($this->password);
        }

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
                'email.required' => 'El código postal es obligatorio.',
                'email.regex' => 'Introduce un email válido',

            ]
        );

        // Encuentra el identificador
        $usuariosSave = $usuarios->update($validatedData);

        if ($usuariosSave) {
            $this->alert('success', '¡Usuario actualizado correctamente!', [
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

        session()->flash('message', 'Usuario actualizado correctamente.');

        $this->emit('userUpdated');
    }

    // Eliminación
    public function destroy()
    {

        $this->alert('warning', '¿Seguro que desea borrar el usuario? No hay vuelta atrás', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmDelete',
            'confirmButtonText' => 'Sí',
            'showDenyButton' => true,
            'denyButtonText' => 'No',
            'timerProgressBar' => true,
        ]);
    }

    // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
            'confirmDelete',
            'destroy',
            'update',
            'duplicate'
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('usuarios.index');
    }

    public function duplicate()
    {
        // Do something
        return redirect()->route('usuarios.duplicar', $this->identificador);
    }
    // Función para cuando se llama a la alerta
    public function confirmDelete()
    {
        $usuario = User::find($this->identificador);
        // $comunidad = Comunidad::where('user_id', $this->identificador)->first();
        // $secciones = Seccion::where('comunidad_id', $comunidad->id)->get();
        // foreach ($secciones as $seccion) {
        //     if ($seccion->seccion_incidencias == 0) {
        //         $anuncios = Anuncio::where('seccion_id', $seccion->id)->delete();
        //     } else {
        //         $anuncios = Incidencia::where('comunidad_id', $comunidad->id)->delete();
        //     }
        // }
        // $secciones->delete();
        // $comunidad->delete();
        $carpetaUsuario = 'carpeta/' . $usuario->id . '_' . str_replace(' ', '_', $usuario->name) . '_' . str_replace(' ', '_', $usuario->surname);

        if (Storage::exists($carpetaUsuario)) {
            dd($carpetaUsuario);
            Storage::deleteDirectory($carpetaUsuario);
        }

        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
}

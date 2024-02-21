<?php

namespace App\Http\Livewire\Notas;

use App\Models\Nota;
//use App\Models\Servicio;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CreateComponent extends Component
{

    use LivewireAlert;

    public $user_id;
    public $descripcion;



    public function mount()
    {
    }



    public function render()
    {
        return view('livewire.notas.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate(
            [
                'descripcion' => 'required',

            ],
            // Mensajes de error
            [
                'descripcion.required' => 'No se puede mandar una nota vacia.',
            ]
        );

        // Guardar datos validados
        $noteSaved = Nota::create($validatedData);
        // event(new \App\Events\LogEvent(Auth::user(), 20, $monitorSave->id));

        // Alertas de guardado exitoso
        if ($noteSaved) {
            $this->alert('success', '¡Nota enviada correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido enviar la nota!', [
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
        // return redirect()->route('monitor.index');
    }
}

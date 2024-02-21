<?php

namespace App\Http\Livewire\Notas;

use App\Models\Nota;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class IndexComponent extends Component
{
    use LivewireAlert;

    // public $search;
    public $notas;
    public $user_id;
    public $socio_id;
    public $descripcion;


    public function mount()
    {
        $this->notas = Nota::all()->take(5);
    }

    public function render()
    {

        return view('livewire.notas.index-component');
    }

    public function submit()
    {

        if(Auth::user()->role == 1){
            $socio_id = Auth::user()->id;
        } else {
            $user_id = Auth::user()->id;
        }

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

        $validatedData['user_id'] = $this->user_id;
        $validatedData['socio_id'] = $this->socio_id;

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
        return redirect()->route('home');
    }

}

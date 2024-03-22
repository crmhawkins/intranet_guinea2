<?php

namespace App\Http\Livewire\Notas;

use App\Models\Alertas;
use App\Models\Nota;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class IndexComponent extends Component
{
    use LivewireAlert;

    // public $search;
    public $identificador;

    public $notas;
    public $user_id;
    public $socio_id;
    public $descripcion;
    public $currentUserId;
    public $targetName;
    private $author;
    private $fecha;


    public function mount()
    {
    }

    public function render()
    {
        $user = User::find($this->identificador);
        // dd($this->identificador);
        if($this->identificador === Auth::user()->id){
            $this->targetName = $user->name;
            // dd($user);
        }else{
            $this->targetName = User::find(1)->name;
            // dd($this->targetName);
        }


            $this->notas = DB::table('notas')->where('user_id', $user->id)->orderByDesc('created_at')->take(5)->get()->reverse()->values();


            // dd($this->notas);


        $this->currentUserId = Auth::user()->id;

        return view('livewire.notas.index-component');
    }

    public function submit()
    {
        $this->author = Auth::user()->id;
        $this->fecha = now();

        if(Auth::user()->role == 1){
            $this->socio_id = Auth::user()->id;
            $this->user_id = $this->identificador;
        } else {
            $lastNote = $this->notas->first();

            if($lastNote){
                $this->socio_id = $lastNote['socio_id'];
            } else {
                $this->socio_id = 1;
            }

            $this->user_id = Auth::user()->id;
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
        $validatedData['author'] = $this->author;
        $validatedData['fecha'] = $this->fecha;

        // dd($validatedData);
        // Guardar datos validados
        $noteSaved = Nota::create($validatedData);
        // event(new \App\Events\LogEvent(Auth::user(), 20, $monitorSave->id));

        // Alertas de guardado exitoso
        if ($noteSaved) {

            if($this->author !== $this->user_id){
                $user_id = $this->user_id;
            }else{
                $user_id = $this->socio_id;
            }
            $alerta = Alertas::create([
                'user_id' => $user_id,
                'titulo' => 'Tienes una nota nueva',
                'tipo' => 3,
                'datetime' => now(),
                'descripcion' => $this->descripcion
            ]);



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
        if($this->identificador){
            return redirect()->route('notes.from', $this->identificador);
        }
        return redirect()->route('home');
    }

}

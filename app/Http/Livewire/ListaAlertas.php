<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Alertas;
use Illuminate\Support\Facades\Auth;

class ListaAlertas extends Component
{

    public $alertas;

    public function mount()
    {
        $this->alertas = Alertas::where('user_id', Auth::id())
                                            ->whereNull('url') // Opcional: Cargar solo notificaciones no leídas
                                            ->get();



    }

    public function render()
    {
        return view('livewire.lista-alertas');
    }

    public function accion($tipo, $user_id, $alertaId)
    {
        $alerta = Alertas::findOrFail($alertaId);
        $alerta->url = "vista";
        $alerta->save();

        switch ($tipo) {
            case 1:
                // return redirect()->to('admin/clientes-edit/'.$referenciaId);
            case 2:
                // return redirect()->to('admin/pedidos-edit/'.$referenciaId);
            case 3:
                return redirect()->route('notes.from', $user_id);
                break;
            case 4:
                $this->alertas = Alertas::where('user_id', $user_id)
                                            ->whereNull('leida') // Opcional: Cargar solo notificaciones no leídas
                                            ->get();
                break;
            case 5:
                $this->alertas = Alertas::where('user_id', Auth::id())
                                            ->whereNull('leida') // Opcional: Cargar solo notificaciones no leídas
                                            ->get();
                break;
            case 6:
                $this->alertas = Alertas::where('user_id', Auth::id())
                                            ->whereNull('leida') // Opcional: Cargar solo notificaciones no leídas
                                            ->get();
                break;
            case 7:
                return redirect()->to('admin/produccion-create');
            default:
                $this->alertas = Alertas::where('user_id', Auth::id())
                                            ->whereNull('url') // Opcional: Cargar solo notificaciones no leídas
                                            ->get();
            break;
        }
    }
}




<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ActualizarTramite extends Component
{
    //datos a actualizar
    public $datosModificarTramite = [];
    public $APIerrors = [];
    //id cliente
    public $idTramite;
    //constructor
    public function mount($id){
        $this->idTramite = $id;
    }
    public function render()
    {
        $respuesta= Http::get('http://127.0.0.1:8000/api/tramite/'.$this->idTramite);
        if ($respuesta->successful()) {
            $tramite= $respuesta->json();
            return view('livewire.actualizar-tramite', compact('tramite'));
        }else {
            dd('Error');
        }

    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ActualizarChofer extends Component
{
    //datos a actualizar
    public $datosModificarChofer = [];
    public $APIerrors = [];
    //id cliente
    public $idChofer;
    //constructor
    public function mount($id)
    {
        $this->idChofer = $id;
    }
    public function render()
    {

        //Obtener Choferes
        $choferes = Http::get('http://127.0.0.1:8000/api/choferes');
        $choferesToFront = $choferes->json();

        $respuesta = Http::get('http://127.0.0.1:8000/api/chofer/' . $this->idChofer);
        if ($respuesta->successful()) {
            $chofer = $respuesta->json();

        } else {
            dd('error');
            $this->APIerrors = $respuesta['message'];
        }
        return view('livewire.actualizar-chofer', compact('chofer', 'choferesToFront'));
    }

    public function actualizarChofer(){
         //valida los campos si no lo inserta como en el back
         $camposParaValidar = ['fechaNacimiento', 'numCelular', 'noVisa'];
         foreach($camposParaValidar as $campo){
             if (!array_key_exists($campo, $this->datosModificarChofer)) {
                 $nuevosCampos = [
                     $campo => "",
                 ];
                 $this->datosModificarChofer = array_merge($nuevosCampos, $this->datosModificarChofer);
             }
         }
        //mandar peticion PUT
        $respuesta = Http::withHeaders(['Accept'=>'Application/json'])->put('http://127.0.0.1:8000/api/chofer/'.$this->idChofer, $this->datosModificarChofer);
       if ($respuesta->successful()) {
            return redirect('/choferes');
        }else {
            $this->APIerrors = $respuesta->json();
        }
    }
}

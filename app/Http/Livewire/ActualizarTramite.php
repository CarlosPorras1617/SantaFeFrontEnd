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
    public function mount($id)
    {
        $this->idTramite = $id;
    }
    public function render()
    {


        //Obtener Clientes
        $clients = Http::get('http://127.0.0.1:8000/api/clientes/');
        $clientsToFront = $clients->json();
        //Obtener Choferes
        $choferes = Http::get('http://127.0.0.1:8000/api/choferes');
        $choferesToFront = $choferes->json();

        //Obtener PedimentosA1
        $pedimentosA1 = Http::get('http://127.0.0.1:8000/api/pedimentosa1/');
        $pedimentosA1ToFront = $pedimentosA1->json();

        //Obtener PedimentosRT
        $pedimentosRT = Http::get('http://127.0.0.1:8000/api/pedimentosrt/');
        $pedimentosRTToFront = $pedimentosRT->json();

        $respuesta = Http::get('http://127.0.0.1:8000/api/tramite/' . $this->idTramite);
        if ($respuesta->successful()) {
            $tramite = $respuesta->json();
            //obtener nombre chofer
            $getDataChofer = Http::get('http://127.0.0.1:8000/api/chofer/' . $tramite['id']);
            if ($getDataChofer->successful()) {
                $choferJson = $getDataChofer->json();
                $nombreChofer = $choferJson['nombre'];
            }

        } else {
            dd('error');
            $responseData = $respuesta->json();
            $this->APIerrors = $responseData['message'];
        }
        return view('livewire.actualizar-tramite', compact('tramite', 'nombreChofer', 'clientsToFront', 'pedimentosRTToFront', 'choferesToFront', 'pedimentosA1ToFront'));
    }

    public function actualizarTramite(){
        //mandar peticion PUT
        $respuesta = Http::withHeaders(['Accept'=>'Application/json'])->put('http://127.0.0.1:8000/api/tramite/'.$this->idTramite, $this->datosModificarTramite);
       if ($respuesta->successful()) {
            return redirect('/tramites');
        }else {
            $this->APIerrors = $respuesta->json();
        }
    }
}

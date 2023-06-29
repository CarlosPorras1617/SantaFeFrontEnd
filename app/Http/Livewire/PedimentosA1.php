<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class PedimentosA1 extends Component
{
    //cualquier cambio de variable en esta parte, ejecuta la funcion de render y se actualzian los datos
    public $currentPage = 1;
    public $idPedimentoA1;
    public $pedimentoA1ToUpdate = [];
    public $dataPedimentoA1 = [];
    public $APIerrors =  [];
    public $semana= null;
    public $errorCodigo = 0;

    public function render()
    {
        //Obtiene registro busqueda
        $searchBySemana = Http::get('http://127.0.0.1:8000/api/likePedimentoa1/?semana=' . $this->semana);
        $pedimentosA1Found = $searchBySemana->json();
        //Obtiene los registros en base a la página
        $totalPaginated = Http::get('http://127.0.0.1:8000/api/pedimentosa1/activos?page=' . $this->currentPage);
        //Peticion a PedimentosA1 para obtener el total de pedimentosA1 para la paginación
        $response = Http::get('http://127.0.0.1:8000/api/pedimentosa1/');
        //Contamos los registros que hay de pedimentosA1
        if ($response->successful()) {
            $data = $response->json();
            $totalPedimentosA1 = count($data);
        }else{
            throw new Exception('La solicitud a la API no fue exitosa');
        }
        $totalPedimentosA1 = count($response->json());
        //Indicamos que los pedimentosA1 que iran al front son los que trajo la url paginados
        $pedimentosA1 = $totalPaginated->json();
        //Current page para el front
        $currentpage = $pedimentosA1['current_page'];

        return view('livewire.pedimentos-a1', compact('pedimentosA1','totalPedimentosA1', 'currentpage', 'pedimentosA1Found'));
    }

    public function nextsPages($i){
        //si mandamos la pagina nueva, cargara de nuevo la funcion render y renderizara la tabla en base a la nueva pagina
        $this->currentPage= $i;
    }

    public function deletePedimentoA1($id){
        $this->idPedimentoA1 = $id;
        $response = Http::delete('http://127.0.0.1:8000/api/pedimentoa1/eliminar/'. $this->idPedimentoA1);
        if (!$response->successful()) {

        }else{
            $this->APIerrors = $response->json();
            redirect('/pedimentosA1');
        }
    }
    public function createPedimentoA1(){
        $response = Http::withHeaders(['Accept' => 'Application/son'])->post('http://127.0.0.1:8000/api/pedimentoa1', $this->dataPedimentoA1);
        if ($response->successful()) {
            $this->dataPedimentoA1 = [];
            $this->pedimentoA1ToUpdate = [];
            $this->APIerrors = [];
        }else{
            $this->APIerrors = $response['message'];
        }
    }
}

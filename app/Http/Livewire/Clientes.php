<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
class Clientes extends Component
{
    //cualquier cambio de variable en esta parte, ejecuta la funcion de render y se actualzian los datos
    public $currentPage = 1;
    public $idClient;
    public $clientToUpdate = [];
    public $dataClient = [];
    public $APIerrors =  [];


    public function render()
    {
        //obtiene los registros en base la pagina
        $totalPaginated = Http::get('http://127.0.0.1:8000/api/clientes/activos?page=' . $this->currentPage);
        //peticion a clientes sin paginacion para obtener el total de clientes para la paginacion
        $response = Http::get('http://127.0.0.1:8000/api/clientes/');
        //contamos los registros que hay de clientes
        $totalClients = count($response->json());
        //indicamos que los clientes que iran al front son los que se trajo la url paginados
        $clients = $totalPaginated->json();
        //current page para el front
        $currentpage = $clients['current_page'];
        return view('livewire.clientes', compact('clients', 'totalClients', 'currentpage'));
    }

    public function nextsPages($i){
        //si mandamos la pagina nueva, cargara de nuevo la funcion render y renderizara la tabla en base a la nueva pagina
        $this->currentPage = $i;
    }

    public function deleteClient($id){
        $this->idClient = $id;
        $response = Http::delete('http://127.0.0.1:8000/api/clientes/eliminar/'.$this->idClient);
        if (!$response->successful()) {

        }else{
            $this->APIerrors = $response->json();
            redirect('/clientes');
        }
    }

    public function createClient(){
        $response = Http::withHeaders(['Accept' => 'Application/json'])->post('http://127.0.0.1:8000/api/clientes', $this->dataClient);
        if ($response->successful()) {
            $this->dataClient = [];
            $this->clientToUpdate = [];
        }else{
            $this->APIerrors = $response->json();
        }
    }

    public function getClient($id){
        //get client
        $response = Http::get('http://127.0.0.1:8000/api/cliente/' . $id);
        $client = $response->json();
        $this->clientToUpdate = $client;
    }

    public function updateClient($id){
        $response = Http::withHeaders(['Accept'=>'Application/json'])->put('http://127.0.0.1:8000/api/cliente/'.$id, $this->dataClient);
       if ($response->successful()) {
            $this->dataClient = [];
        }else {
            $this->APIerrors = $response->json();
        }
    }

    public function cancelUpdate(){
        $this->clientToUpdate = [];
    }
}

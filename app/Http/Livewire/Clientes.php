<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
class Clientes extends Component
{
    //cualquier cambio de variable en esta parte, ejecuta la funcion de render y se actualzian los datos
    public $currentPage = 1;
    public $idClient;
    public $dataCreateClient = [];
    public $errors =  [];

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
    public function nextsPages($i)
    {
        //si mandamos la pagina nueva, cargara de nuevo la funcion render y renderizara la tabla en base a la nueva pagina
        $this->currentPage = $i;
    }
    public function deleteClient($id){
        $this->idClient = $id;
        $response = Http::delete('http://127.0.0.1:8000/api/clientes/eliminar/'.$this->idClient);
        if (!$response->successful()) {

        }else{
            $this->errors = $response->json();
            redirect('/clientes');
        }
    }
}

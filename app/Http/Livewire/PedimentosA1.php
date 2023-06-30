<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Exception\RequestException;

class PedimentosA1 extends Component
{
    //cualquier cambio de variable en esta parte, ejecuta la funcion de render y se actualzian los datos
    public $currentPage = 1;
    public $idPedimentoA1;
    public $pedimentoA1ToUpdate = [];
    public $dataPedimentoA1 = [];
    public $APIerrors =  [];
    public $semana = null;
    public $errorCodigo = 0;
    public $pedimentosA1 = [];


    public function render()
    {
        $totalPedimentosA1 = 0;

        $currentpage = null;
        //Obtiene registro busqueda
        $searchBySemana = Http::get('http://127.0.0.1:8000/api/likePedimentoa1/?semana=' . $this->semana);
        $pedimentosA1Found = $searchBySemana->json();
        //Obtiene los registros en base a la página
        //$totalPaginated = Http::get('http://127.0.0.1:8000/api/pedimentosa1/activos?page=' . $this->currentPage);
        //Peticion a PedimentosA1 para obtener el total de pedimentosA1 para la paginación
        //$response = Http::get('http://127.0.0.1:8000/api/pedimentosa1/');
        //Contamos los registros que hay de pedimentosA1
        $client = new Client();
        $retries = 0;
        $maxRetries = 3;
        $retryDelay = 1;
        do {
            try {
                $promise2 = $client->getAsync('http://127.0.0.1:8000/api/pedimentosa1/activos?page=' . $this->currentPage);
                $response2 = $promise2->wait();

                $promise = $client->getAsync('http://127.0.0.1:8000/api/pedimentosa1/');
                $response= $promise->wait();

                $data = $response->getBody()->getContents();
                $dataJson = json_decode($data);
                $totalPedimentosA1 = count($dataJson);

                $data2 = $response2->getBody()->getContents();
                $this->pedimentosA1 = json_decode($data2,true);
                $currentpage = $this->pedimentosA1['current_page'];
                break;
            } catch (RequestException $exception) {
                if ($exception->getResponse()->getStatusCode() == 429 && $retries < $maxRetries) {
                    sleep($retryDelay); // Esperar antes de reintentar la solicitud
                    $retries++;
                } else {
                    dd($exception); // Manejar otras excepciones
                }
            }
        } while ($retries < $maxRetries);


        //if ($response->successful()) {
        //    $data = $response->json();
        //    $totalPedimentosA1 = count($data);
        //}else{
        //    throw new Exception('La solicitud a la API no fue exitosa');
        //}
        //$totalPedimentosA1 = count($response->json());
        //Indicamos que los pedimentosA1 que iran al front son los que trajo la url paginados
        //$pedimentosA1 = $totalPaginated->json();
        //Current page para el front
        //$currentpage = $pedimentosA1['current_page'];

        return view('livewire.pedimentos-a1', compact('totalPedimentosA1', 'currentpage', 'pedimentosA1Found'));
    }

    public function nextsPages($i)
    {
        //si mandamos la pagina nueva, cargara de nuevo la funcion render y renderizara la tabla en base a la nueva pagina
        $this->currentPage = $i;
    }

    public function deletePedimentoA1($id)
    {
        $this->idPedimentoA1 = $id;
        $response = Http::delete('http://127.0.0.1:8000/api/pedimentoa1/eliminar/' . $this->idPedimentoA1);
        if (!$response->successful()) {
        } else {
            $this->APIerrors = $response->json();
            redirect('/pedimentosA1');
        }
    }

    public function createPedimentoA1()
    {
        $response = Http::withHeaders(['Accept' => 'Application/son'])->post('http://127.0.0.1:8000/api/pedimentoa1', $this->dataPedimentoA1);
        if ($response->successful()) {
            $this->dataPedimentoA1 = [];
            $this->pedimentoA1ToUpdate = [];
            $this->APIerrors = [];
        } else {
            $responseData = $response->json();
            if (isset($responseData['message'])) {
                $this->APIerrors = $responseData['message'];
            } else {
                $this->APIerrors = 'Error desconocido en la respuesta del API.';
            }
        }
    }

    public function updatePedimentoA1($id){
        $response = Http::withHeaders(['Accept' => 'Application/json'])->put('http://127.0.0.1:8000/api/pedimentoa1/' . $id, $this->dataPedimentoA1);
        if ($response->successful()) {
            $this->dataPedimentoA1 = [];
        } else {
            $this->APIerrors = $response->json();
        }
    }

    public function getPedimentoA1($id)
    {
        //get client
        $response = Http::get('http://127.0.0.1:8000/api/pedimentoa1/' . $id);
        $pedimentoA1 = $response->json();
        $this->pedimentoA1ToUpdate = $pedimentoA1;
    }

    public function cancelUpdate()
    {
        $this->pedimentoA1ToUpdate = [];
    }
}

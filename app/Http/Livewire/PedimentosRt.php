<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PedimentosRt extends Component
{
    //cualquier cambio de variable en esta parte, ejecuta la funcion de render y se actualzian los datos
    public $currentPage = 1;
    public $idPedimentoRT;
    public $pedimentoRTToUpdate = [];
    public $dataPedimentoRT = [];
    public $APIerrors =  [];
    public $semana = null;
    public $errorCodigo = 0;
    public $pedimentosRT = [];


    public function render()
    {
        $totalPedimentosRT = 0;

        $currentpage = null;
        //Obtiene registro busqueda
        $searchBySemana = Http::get('http://127.0.0.1:8000/api/likePedimentoa1/?semana=' . $this->semana);
        $pedimentosRTFound = $searchBySemana->json();
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
                $promise2 = $client->getAsync('http://127.0.0.1:8000/api/pedimentosrt/activos?page=' . $this->currentPage);
                $response2 = $promise2->wait();

                $promise = $client->getAsync('http://127.0.0.1:8000/api/pedimentosrt/');
                $response= $promise->wait();

                $data = $response->getBody()->getContents();
                $dataJson = json_decode($data);
                $totalPedimentosRT = count($dataJson);

                $data2 = $response2->getBody()->getContents();
                $this->pedimentosRT = json_decode($data2,true);
                $currentpage = $this->pedimentosRT['current_page'];
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

        return view('livewire.pedimentos-rt', compact('totalPedimentosRT', 'currentpage', 'pedimentosRTFound'));
    }

    public function nextsPages($i)
    {
        //si mandamos la pagina nueva, cargara de nuevo la funcion render y renderizara la tabla en base a la nueva pagina
        $this->currentPage = $i;
    }

    public function deletePedimentoRT($id)
    {
        $this->idPedimentoRT = $id;
        $response = Http::delete('http://127.0.0.1:8000/api/pedimentort/eliminar/' . $this->idPedimentoRT);
        if (!$response->successful()) {
        } else {
            $this->APIerrors = $response->json();
            redirect('/pedimentosRt');
        }
    }

    public function createPedimentoRT()
    {
        $response = Http::withHeaders(['Accept' => 'Application/son'])->post('http://127.0.0.1:8000/api/pedimentort', $this->dataPedimentoRT);
        if ($response->successful()) {
            $this->dataPedimentoRT = [];
            $this->pedimentoRTToUpdate = [];
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

    public function updatePedimentoRT($id){
        $response = Http::withHeaders(['Accept' => 'Application/json'])->put('http://127.0.0.1:8000/api/pedimentort/' . $id, $this->dataPedimentoRT);
        if ($response->successful()) {
            $this->dataPedimentoRT = [];
        } else {
            $this->APIerrors = $response->json();
        }
    }

    public function getPedimentoRT($id)
    {
        //get client
        $response = Http::get('http://127.0.0.1:8000/api/pedimentort/' . $id);
        $pedimentoRT = $response->json();
        $this->pedimentoRTToUpdate = $pedimentoRT;
    }

    public function cancelUpdate()
    {
        $this->pedimentoRTToUpdate = [];
    }
}

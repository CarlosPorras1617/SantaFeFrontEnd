<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class TramitesRecogidos extends Component
{
    //cualquier cambio de variable en esta parte, ejecuta la funcion de render y se actualzian los datos
    public $currentPage = 1;
    public $idTramite;
    public $dataTramite = [];
    public $APIerrors =  [];
    public $numEntrada = null;
    public $tramites = [];
    public function render()
    {

        $totalTramites = 0;

        $currentpage = null;
        //Obtiene registro busqueda
        $searchByNumEntrada = Http::get('http://127.0.0.1:8000/api/likeTramite/?numEntrada=' . $this->numEntrada);
        $tramiteFound = $searchByNumEntrada->json();

        $client = new Client();
        $retries = 0;
        $maxRetries = 3;
        $retryDelay = 1;

        do {
            try {
                $promise2 = $client->getAsync('http://127.0.0.1:8000/api/tramites/inactivos?page=' . $this->currentPage);
                $response2 = $promise2->wait();

                $promise = $client->getAsync('http://127.0.0.1:8000/api/tramites/todosInactivos');
                $response = $promise->wait();

                $data = $response->getBody()->getContents();
                $dataJson = json_decode($data);
                $totalTramites = count($dataJson);

                $data2 = $response2->getBody()->getContents();
                $this->tramites = json_decode($data2, true);
                $currentpage = $this->tramites['current_page'];
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

        return view('livewire.tramites-recogidos', compact('totalTramites', 'currentpage', 'tramiteFound'));
    }

    public function nextsPages($i)
    {
        //si mandamos la pagina nueva, cargara de nuevo la funcion render y renderizara la tabla en base a la nueva pagina
        $this->currentPage = $i;
    }

    public function deleteTramite($id)
    {
        $this->idTramite = $id;
        $response = Http::delete('http://127.0.0.1:8000/api/tramite/eliminar/' . $this->idTramite);
        if (!$response->successful()) {
        } else {
            $this->APIerrors = $response->json();
            redirect('/tramitesRecogidos');
        }
    }
}

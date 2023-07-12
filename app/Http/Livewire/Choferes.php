<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class Choferes extends Component
{
    //cualquier cambio de variable en esta parte, ejecuta la funcion de render y se actualzian los datos
    public $currentPage = 1;
    public $idChofer;
    public $dataChofer = [];
    public $APIerrors =  [];
    public $nombreChofer = null;
    public $choferes = [];
    public function render()
    {
        //Obtener Choferes
        $choferes = Http::get('http://127.0.0.1:8000/api/choferes');
        $choferesToFront = $choferes->json();

        $totalChoferes = 0;

        $currentpage = null;
        //Obtiene registro busqueda
        $searchByNombre = Http::get('http://127.0.0.1:8000/api/likeChofer?nombre=' . $this->nombreChofer);
        $choferFound = $searchByNombre->json();

        $client = new Client();
        $retries = 0;
        $maxRetries = 3;
        $retryDelay = 1;
        do {
            try {
                $promise2 = $client->getAsync('http://127.0.0.1:8000/api/choferes/activos?page=' . $this->currentPage);
                $response2 = $promise2->wait();

                $promise = $client->getAsync('http://127.0.0.1:8000/api/choferes');
                $response = $promise->wait();

                $data = $response->getBody()->getContents();
                $dataJson = json_decode($data);
                $totalChoferes = count($dataJson);

                $data2 = $response2->getBody()->getContents();
                $this->choferes = json_decode($data2, true);
                $currentpage = $this->choferes['current_page'];
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
        return view('livewire.choferes', compact('totalChoferes', 'currentpage', 'choferFound', 'choferesToFront', ));
    }

    public function nextsPages($i)
    {
        //si mandamos la pagina nueva, cargara de nuevo la funcion render y renderizara la tabla en base a la nueva pagina
        $this->currentPage = $i;
    }

    public function deleteChofer($id)
    {
        $this->idChofer = $id;
        $response = Http::delete('http://127.0.0.1:8000/api/chofer/eliminar/' . $this->idChofer);
        if (!$response->successful()) {

        } else {
            $this->APIerrors = $response->json();
            redirect('/choferes');
        }
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Tramites extends Component
{
    //cualquier cambio de variable en esta parte, ejecuta la funcion de render y se actualzian los datos
    public $currentPage = 1;
    public $idTramite;
    public $tramiteToUpdate = [];
    public $dataTramite = [];
    public $APIerrors =  [];
    public $numEntrada = null;
    public $errorCodigo = 0;
    public $tramites = [];

    public function render()
    {
        //Obtener Clientes
        $clients = Http::get('http://127.0.0.1:8000/api/clientes/');
        $clientsToFront = $clients->json();

        //Obtener PedimentosA1
        $pedimentosA1 = Http::get('http://127.0.0.1:8000/api/pedimentosa1/');
        $pedimentosA1ToFront = $pedimentosA1->json();

        //Obtener PedimentosRT
        $pedimentosRT = Http::get('http://127.0.0.1:8000/api/pedimentosrt/');
        $pedimentosRTToFront = $pedimentosRT->json();

        //Obtener Choferes
        $choferes = Http::get('http://127.0.0.1:8000/api/choferes');
        $choferesToFront = $choferes->json();

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
                $promise2 = $client->getAsync('http://127.0.0.1:8000/api/tramites/activos?page=' . $this->currentPage);
                $response2 = $promise2->wait();

                $promise = $client->getAsync('http://127.0.0.1:8000/api/tramites');
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
        return view('livewire.tramites', compact('totalTramites', 'currentpage', 'tramiteFound', 'clientsToFront', 'pedimentosA1ToFront', 'pedimentosRTToFront', 'choferesToFront'));
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
            redirect('/tramites');
        }
    }

    public function createTramite()
    {
        //Obtenemos datos del chofer para añadirla en el view de la tabla sus datos y no IDS
        $getDataChofer = Http::get('http://127.0.0.1:8000/api/chofer/' . $this->dataTramite['chofer']);
        if ($getDataChofer->successful()) {
            //obtenemos chofer
            $choferJson = $getDataChofer->json();
            //obtenemos su nombre
            $nombreChofer = $choferJson['nombre'];
            //obtenemos su celular
            $numCelular = $choferJson['numCelular'];
            //obtenemos su licencia
            $licencia = $choferJson['noLicencia'];
            //preparamos el array
            $nuevosCampos = [
                'cellChofer' => $numCelular,
                'noLicenciaChofer' => $licencia
            ];
            //añadimos los campos nuevos del chofer a la data para insertar al chofer
            $this->dataTramite = array_merge($nuevosCampos, $this->dataTramite);
        }
        //sustituimos ID por nombre de chofer ahora dataTramite nombre guarda su nombre y no el ID del chofer a insertar
        $this->dataTramite = array_replace($this->dataTramite, ['chofer' => $nombreChofer]);
        $response = Http::withHeaders(['Accept' => 'Application/son'])->post('http://127.0.0.1:8000/api/tramites', $this->dataTramite);
        if ($response->successful()) {
            $this->dataTramite = [];
            $this->tramiteToUpdate = [];
            $this->APIerrors = [];
            redirect('/tramites');
        } else {
            $responseData = $response->json();
            if (isset($responseData['message'])) {
                $this->APIerrors = $responseData['message'];
                dd($this->APIerrors);
            } else {
                $this->APIerrors = 'Error desconocido en la respuesta del API.';
            }
        }
    }
}

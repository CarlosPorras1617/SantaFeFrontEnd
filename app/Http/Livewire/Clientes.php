<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
class Clientes extends Component
{
    public $idCliente;
    public $dataCreateClient = [];
    public $errors =  [];

    public function render()
    {
        $response = Http::get('http://127.0.0.1:8000/api/clientes');
        $clients = $response->json(["data"]);
        return view('livewire.clientes', compact('clients'));
    }
}

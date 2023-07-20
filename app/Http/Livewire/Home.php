<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Home extends Component
{
    public $numEntrada;
    public $tramite = [];
    public function render()
    {
        $characterCount = strlen($this->numEntrada);
        if ($characterCount == 11) {
            //get tramite
            $response = Http::get('http://127.0.0.1:8000/api/tramite/numEntrada/' . $this->numEntrada);

            $this->tramite = $response->json();
            $this->emit('cargando', $this->tramite);
        }
        return view('livewire.home');
    }

    public function searchTramite()
    {
        //get tramite
        $response = Http::get('http://127.0.0.1:8000/api/tramite/numEntrada/' . $this->numEntrada);

        $this->tramite = $response->json();
    }
}

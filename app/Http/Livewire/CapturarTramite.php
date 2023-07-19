<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CapturarTramite extends Component
{
    public $inputText = '';
    public $APIerrors = [];

    public function updatedInputText()
    {
        $characterCount = strlen($this->inputText);
        if ($characterCount == 12) {
            $response = Http::withHeaders(['Accept' => 'Application/json'])->put('http://127.0.0.1:8000/api/tramite/capturar/' . $this->inputText);
            $this->emit('cargando', true);
            if ($response->successful()) {
                redirect('/capturar');
                $this->APIerrors = [];
            } else {
                $this->APIerrors = $response->json();
            }
        }
    }

    public function render()
    {
        return view('livewire.capturar-tramite');
    }
}

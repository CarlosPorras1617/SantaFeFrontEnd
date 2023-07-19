<div class="capturar">
    <div class="container center-align">
        <div class="row">
            <div class="col s12">
                <h1>ESCANEAR CÓDIGO DE BARRAS</h1>
                <br>
                <br>
                <div class="input-field">
                    <input type="number" wire:model="inputText" id="capturarTramite" class="validate center" autofocus>
                </div>
                @if ($APIerrors)
                    <h4>Cargando</h4>
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    <p>ERROR: {{$APIerrors['message']}}</p>
                    <a class="btn pedimentoRTFormButton" href="/capturar">REINTENTAR</a>
                @endif
                <script>
                    document.addEventListener('livewire:load', function() {
                        Livewire.on('cargando', function(cargando) {
                            // Ejecutar la función que desees aquí, o mostrar un mensaje
                            console.log("Tramite Capturado");
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

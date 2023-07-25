<div wire:ignore.self>
    <form>
        <div class="row">
            <div class="input-field col s8">

                <div class="input-field col s6">
                    <!--Defer para que no se quite el character counter--->
                    <select wire:ignore.self class="form-select" wire:model.defer='datosModificarChofer.nombre'>
                        <option value=""> </option>
                        @foreach ($choferesToFront as $choferNombre)
                            <option wire:ignore.self value="{{ $choferNombre['nombre'] }}">{{ $choferNombre['nombre'] }}
                            </option>
                        @endforeach
                    </select>
                    <label for="nombreChofer" class="active">Nombre: {{ $chofer['nombre'] }}</label>
                </div>
                <div class="input-field col s6">
                    <input id="fechaNacimiento" type="date" wire:model.defer='datosModificarChofer.fechaNacimiento'
                        class="validate">
                    <label for="fechaNacimiento">Nacimiento: {{ $chofer['fechaNacimiento'] == '1900-01-01' ? 'NA' : $chofer['fechaNacimiento'] }}</label>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="numCelular" type="number" wire:model.defer='datosModificarChofer.numCelular'
                            class="validate">
                        <label for="numCelular">Celular: {{ $chofer['numCelular'] == 0 ? "NA" : $chofer['numCelular'] }}</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="noLicencia" type="text" wire:model.defer='datosModificarChofer.noLicencia'
                            class="validate">
                        <label for="noLicencia">Licencia: {{ $chofer['noLicencia'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="noVisa" type="text" wire:model.defer='datosModificarChofer.noVisa'
                            class="validate">
                        <label for="noVisa">Visa: {{ $chofer['noVisa'] }}</label>
                    </div>
                </div>
            </div>
            <div class="input-field col s4">
                <div class="center">
                    <img class="imagenLogoActualizar" src="{{ asset('images/santaFe.jpeg') }}">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <!--SI LA API ARROJA UN ERROR ACTIVA UN MODAL-->
                    @if ($APIerrors)
                        <div wire:ignore.self class="contenedorErroresActualizar center">
                            @foreach ($APIerrors['message'] as $error)
                                @foreach ($error as $errorMessage)
                                    <h6>{{ $errorMessage }}</h6>
                                    <div class="divider"></div>
                                @endforeach
                            @endforeach
                            <br>
                            <a class="btn pedimentoRTFormButton" href="/chofer/{{$chofer['id']}}">REINTENTAR</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <a class="btn pedimentoRTFormButton" wire:click='actualizarChofer()'>ACTUALIZAR</a>
        <a class="btn pedimentoRTFormButton" href="/choferes">REGRESAR</a>
    </form>
</div>

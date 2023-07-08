<div wire:ignore.self class="row">
    <form wire:ignore.self class="col s12">
        <div wire:ignore.self class="row">
            <div class="input-field col s8">
                <div class="row">
                    <div class="input-field col s6">
                        <!--Defer para que no se quite el character counter--->
                        <input id="numEntrada" type="number" wire:model.defer='datosModificarTramite.numEntrada'
                            class="validate" data-length="11">
                        <label for="numEntrada" class="active">Num Entrada: {{ $tramite['numEntrada'] }}</label>
                    </div>
                    <div wire:ignore.self class="input-field col s6">
                        <select wire:ignore.self class="form-select" wire:model.defer='datosModificarTramite.cliente'>
                            <option value=""> </option>
                            @foreach ($clientsToFront as $clients)
                                <option wire:ignore.self value="{{ $clients['nombre'] }}">{{ $clients['nombre'] }}</option>
                            @endforeach
                        </select>
                        <label for="cliente">Cliente: {{ $tramite['cliente'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="candados" type="text" wire:model.defer='datosModificarTramite.candados'
                            class="validate">
                        <label for="candados">Candados: {{ $tramite['candados'] }}</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="factura" type="text" wire:model.defer='datosModificarTramite.factura'
                            class="validate">
                        <label for="factura">Factura: {{ $tramite['factura'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select class="red" wire:model.defer='datosModificarTramite.pedimentoRT'>
                            <option value=""> </option>
                            @foreach ($pedimentosRTToFront as $pedimentoRT)
                                <option value="{{ $pedimentoRT['noPedimento'] }}">
                                    {{ $pedimentoRT['noPedimento'] }}</option>
                            @endforeach
                        </select>
                        <label for="pedimentoRT">PedimentoRT: {{ $tramite['pedimentoRT'] }} RT</label>
                    </div>
                    <div class="input-field col s6">
                        <select class="form-select" wire:model.defer='datosModificarTramite.pedimentoA1'>
                            <option value="0000000">0000000</option>
                            @foreach ($pedimentosA1ToFront as $pedimentoA1)
                                <option value="{{ $pedimentoA1['noPedimento'] }}">
                                    {{ $pedimentoA1['noPedimento'] }}</option>
                            @endforeach
                        </select>
                        <label for="pedimentoA1">PedimentoA1: {{ $tramite['pedimentoA1'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select class="form-select" wire:model.defer='datosModificarTramite.chofer'>
                            <option value=""> </option>
                            @foreach ($choferesToFront as $chofer)
                                <option value="{{ $chofer['nombre'] }}">
                                    {{ $chofer['nombre'] }}
                                </option>
                            @endforeach
                        </select>
                        <label for="chofer">Chofer: {{ $tramite['chofer'] }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="bultos" type="text" wire:model.defer='datosModificarTramite.numBultos'
                            class="validate">
                        <label for="bultos">Bultos: {{ $tramite['numBultos'] }}</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="placa" type="text" wire:model.defer='datosModificarTramite.placa'
                            class="validate">
                        <label for="placa">Placa: {{ $tramite['placa'] }}</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="economico" type="text" wire:model.defer='datosModificarTramite.economico'
                            class="validate">
                        <label for="economico">Economico: {{ $tramite['economico'] }}</label>
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
                            <a class="btn pedimentoRTFormButton" href="/tramite/{{$tramite['id']}}">REINTENTAR</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <a class="btn pedimentoRTFormButton" wire:click='actualizarTramite()'>ACTUALIZAR</a>
    </form>
</div>

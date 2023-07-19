<div>
    <div class="fondo">

        <!--CONTENEDOR CENTRAL DE LA PAGINA-->
        <div class="contenedorPedimentosA1">

            <!--CONTENEDOR DE BOTONES DE NAVEGACION ENTRE PEDIMENTOS-->
            <div class="fondoBuscarNumEntrada"></div>
            <div class="floatingActionButtonCrearTramite">
                <a class="waves-effect waves-light btn modal-trigger CrearTramite" href="#mi-modal"><i
                        class="material-icons tramites right">control_point</i>Crear Trámite</a>
            </div>
            <div class="buscarByNumEntradaInput">
                <div class="row">
                    <!---BARRA BUSQUEDA-->
                    <div class="input-field">
                        <div class="buscarByNumEntrada">
                            <i class="material-icons prefix">search</i>
                            <input type="number" class="NumEntrada" wire:model='numEntrada' id="buscar">
                            <label for="buscar" class="active">Buscar por numero entrada</label>
                        </div>
                    </div>
                </div>
            </div>

            <!--ROW QUE DIVIDE LA TABLA DEL FORMULARIO-->
            <div class="row center">
                <div class="col s12 m12 l12">
                    <!--INICIO TABLA-->
                    <div class="card-body bg-light" style="border-radius: 10px">
                        <table class="table white">
                            <thead>
                                <tr class="textos center" style="background-color: #AD7A78; ">
                                    <th style="width: 15px">NumEntrada</th>
                                    <th>Factura</th>
                                    <th>PedimentoRT</th>
                                    <th>PedimentoA1</th>
                                    <th>Cliente</th>
                                    <th>Chofer</th>
                                    <th>Cell Chofer</th>
                                    <th>No. Licencia</th>
                                    <th>Placa</th>
                                    <th>Economico</th>
                                    <th>Candados</th>
                                    <th>NumBultos</th>
                                    <th>Barcode</th>
                                    <th>Creado</th>
                                    <th>Actualizado</th>
                                    <th style="width: 80px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="center">

                                <!-- VALIDA SI LA BUSQUEDA POR SEMANA ES NULA, SI LO ES MUESTRA TODOS LOS A1-->
                                @if (is_null($numEntrada) || $numEntrada == '')
                                    @foreach ($tramites['data'] as $tramite)
                                        <tr>
                                            <td>{{ $tramite['numEntrada'] }}</td>
                                            <td>{{ $tramite['factura'] }}</td>
                                            <td>{{ $tramite['pedimentoRT'] }}</td>
                                            <td>{{ $tramite['pedimentoA1'] }}</td>
                                            <td>{{ $tramite['cliente'] }}</td>
                                            <td>{{ $tramite['chofer'] }}</td>
                                            <td>{{ $tramite['cellChofer'] }}</td>
                                            <td>{{ $tramite['noLicenciaChofer'] }}</td>
                                            <td>{{ $tramite['placa'] }}</td>
                                            <td>{{ $tramite['economico'] }}</td>
                                            <td>{{ $tramite['candados'] }}</td>
                                            <td>{{ $tramite['numBultos'] }}</td>
                                            <td>{{ $tramite['barcode'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tramite['created_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($tramite['updated_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat modal-trigger"
                                                    href="/tramite/{{ $tramite['id'] }}" style="margin: auto"><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deleteTramite({{ $tramite['id'] }})'><i
                                                        class="large material-icons">delete</i> </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <!--SI SEMANA NO ES NULA MUESTRA LOS PEDIMENTOS A1 ENCONTRADO-->
                                    @foreach ($tramiteFound['data'] as $tramite)
                                        <tr>
                                            <td>{{ $tramite['numEntrada'] }}</td>
                                            <td>{{ $tramite['factura'] }}</td>
                                            <td>{{ $tramite['pedimentoRT'] }}</td>
                                            <td>{{ $tramite['pedimentoA1'] }}</td>
                                            <td>{{ $tramite['cliente'] }}</td>
                                            <td>{{ $tramite['chofer'] }}</td>
                                            <td>{{ $tramite['cellChofer'] }}</td>
                                            <td>{{ $tramite['noLicenciaChofer'] }}</td>
                                            <td>{{ $tramite['placa'] }}</td>
                                            <td>{{ $tramite['economico'] }}</td>
                                            <td>{{ $tramite['candados'] }}</td>
                                            <td>{{ $tramite['numBultos'] }}</td>
                                            <td>{{ $tramite['barcode'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tramite['created_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($tramite['updated_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    href="/tramite/{{ $tramite['id'] }}"><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deleteTramite({{ $tramite['id'] }})'><i
                                                        class="large material-icons">delete</i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!--FIN DE TABLA-->

                    <!--CREACION DE LA PAGINACION-->
                    <ul class="pagination">
                        @php
                            //CREAMOS CUANTAS DIVISIONES TENDRA EL PAGINATE DIVIDIENDO EL TOTAL DE CLIENTES / LOS MOSTRADOS EN PANTALLA
                            $totalPages = ceil($totalTramites / 10);
                        @endphp
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <!--CREAMOS LOS BOTONES EN BASE A LOS NUMEROS DE REGISTROS CADA UNO CON LA AYUDA DE LA FUNCION NEXTSPAGES Y MANDANDO LA PAGINA A LA QUE NAVEGAREMOS-->
                            <li class="{{ $currentpage == $i ? 'active' : 'waves-effect' }}">
                                <a wire:click='nextsPages({{ $i }})' class="btn paginado"
                                    style="{{ $currentpage == $i ? 'color: #752E2B;' : 'color: #752E2B;' }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>

        <!--Para que no se cierre modal-->
        <div wire:ignore.self id="mi-modal" class="modal">
            <div class="modal-content">
                <h4>CREAR TRÁMITE</h4>
                <form>
                    <div class="row">
                        <div class="input-field col s6">
                            <!--Defer para que no se quite el character counter--->
                            <input id="numEntrada" type="number" wire:model.defer='dataTramite.numEntrada'
                                class="validate" data-length="11">
                            <label for="numEntrada" class="active">Numero Entrada</label>
                        </div>
                        <div class="input-field col s6">
                            <select class="form-select" wire:model.defer='dataTramite.cliente'>
                                <option value=""> </option>
                                @foreach ($clientsToFront as $clients)
                                    <option value="{{ $clients['nombre'] }}">{{ $clients['nombre'] }}</option>
                                @endforeach
                            </select>
                            <label for="cliente">Cliente</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="candados" type="text" wire:model.defer='dataTramite.candados'
                                class="validate">
                            <label for="candados">Candados</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="factura" type="text" wire:model.defer='dataTramite.factura'
                                class="validate">
                            <label for="factura">Factura</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select class="red" wire:model.defer='dataTramite.pedimentoRT'>
                                <option value=""> </option>
                                @foreach ($pedimentosRTToFront as $pedimentoRT)
                                    <option value="{{ $pedimentoRT['noPedimento'] }}">
                                        {{ $pedimentoRT['noPedimento'] }}</option>
                                @endforeach
                            </select>
                            <label for="pedimentoRT">Pedimento RT</label>
                        </div>
                        <div class="input-field col s6">
                            <select class="form-select" wire:model.defer='dataTramite.pedimentoA1'>
                                <option value="">Seleccionar</option>
                                <option value="1111111">1111111</option>
                                @foreach ($pedimentosA1ToFront as $pedimentoA1)
                                    <option value="{{ $pedimentoA1['noPedimento'] }}">
                                        {{ $pedimentoA1['noPedimento'] }}</option>
                                @endforeach
                            </select>
                            <label for="pedimentoA1">Pedimento A1</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <select class="form-select" wire:model.defer='dataTramite.chofer'>
                                <option value=""> </option>
                                @foreach ($choferesToFront as $chofer)
                                    <option value="{{ $chofer['id'] }}">
                                        {{ $chofer['nombre'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="chofer">Chofer</label>
                        </div>

                        <div class="input-field col s3">
                            <input id="bultos" type="text" wire:model.defer='dataTramite.numBultos'
                                class="validate">
                            <label for="bultos">Bultos</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="placa" type="text" wire:model.defer='dataTramite.placa'
                                class="validate">
                            <label for="placa">Placa</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="economico" type="text" wire:model.defer='dataTramite.economico'
                                class="validate">
                            <label for="economico">Economico</label>
                        </div>

                    </div>
                </form>
                <div class="modal-footer">
                    <a class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                    <a wire:click='createTramite' class="btn pedimentoA1FormButton">CREAR</a>
                </div>
            </div>

        </div>

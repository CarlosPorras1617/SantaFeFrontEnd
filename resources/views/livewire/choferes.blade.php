<div>
    <div class="fondo">

        <!--CONTENEDOR CENTRAL DE LA PAGINA-->
        <div class="contenedorPedimentosA1">

            <!--CONTENEDOR DE BOTONES DE NAVEGACION ENTRE CHOFER-->
            <div class="fondoBuscarNumEntrada"></div>
            <div class="floatingActionButtonCrearTramite">
                <a class="waves-effect waves-light btn modal-trigger CrearTramite" href="#choferModal"><i
                        class="material-icons tramites right">control_point</i>Crear Chofer</a>
            </div>
            <div class="buscarByNumEntradaInput">
                <div class="row">
                    <!---BARRA BUSQUEDA-->
                    <div class="input-field">
                        <div class="buscarByNumEntrada">
                            <i class="material-icons prefix">search</i>
                            <input type="text" class="NumEntrada" wire:model='nombreChofer' id="buscar">
                            <label for="buscar" class="active">Buscar por nombre</label>
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
                                    <th style="width: 350px">Nombre</th>
                                    <th>Nacimiento</th>
                                    <th>Celular</th>
                                    <th>Licencia</th>
                                    <th>Visa</th>
                                    <th>Creado</th>
                                    <th>Actualizado</th>
                                    <th style="width: 80px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="center">

                                <!-- VALIDA SI LA BUSQUEDA POR SEMANA ES NULA, SI LO ES MUESTRA TODOS LOS A1-->
                                @if (is_null($nombreChofer))
                                    @foreach ($choferes['data'] as $chofer)
                                        <tr>
                                            <td>{{ $chofer['nombre'] }}</td>
                                            <td>{{ $chofer['fechaNacimiento'] }}</td>
                                            <td>{{ $chofer['numCelular'] }}</td>
                                            <td>{{ $chofer['noLicencia'] }}</td>
                                            <td>{{ $chofer['noVisa'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($chofer['created_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($chofer['updated_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat modal-trigger" href="/chofer/{{ $chofer['id'] }}"
                                                    style="margin: auto"><i class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deleteChofer({{ $chofer['id'] }})'><i
                                                        class="large material-icons">delete</i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <!--SI SEMANA NO ES NULA MUESTRA LOS PEDIMENTOS A1 ENCONTRADO-->
                                    @foreach ($choferFound['data'] as $chofer)
                                        <tr>
                                            <td>{{ $chofer['nombre'] }}</td>
                                            <td>{{ $chofer['fechaNacimiento'] }}</td>
                                            <td>{{ $chofer['numCelular'] }}</td>
                                            <td>{{ $chofer['noLicencia'] }}</td>
                                            <td>{{ $chofer['noVisa'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($chofer['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($chofer['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat modal-trigger"
                                                    href="/chofer/{{ $chofer['id'] }}" style="margin: auto"><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deleteChofer({{ $chofer['id'] }})'><i
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
                            $totalPages = ceil($totalChoferes / 10);
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
        <div wire:ignore.self id="choferModal" class="modal">
            <div class="modal-content">
                <h4>CREAR CHOFER</h4>
                <form>
                    <div class="row">
                        <div class="input-field col s6">
                            <!--Defer para que no se quite el character counter--->
                            <input id="nombreChofer" type="text" wire:model.defer='dataChofer.nombre'
                                class="validate">
                            <label for="nombreChofer" class="active">Nombre Completo</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="fechaNacimiento" type="date" wire:model.defer='dataChofer.fechaNacimiento'
                                class="validate">
                            <label for="fechaNacimiento">Fecha Nacimiento</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="numCelular" type="number" wire:model.defer='dataChofer.numCelular'
                                class="validate">
                            <label for="numCelular">Num Celular</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="noLicencia" type="text" wire:model.defer='dataChofer.noLicencia'
                                class="validate">
                            <label for="noLicencia">Licencia</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="noVisa" type="text" wire:model.defer='dataChofer.noVisa' class="validate">
                            <label for="noVisa">Visa</label>
                        </div>
                    </div>
                    @if ($APIerrors)
                        @foreach ($APIerrors as $error)
                            @foreach ($error as $errorMessage)
                                <h6>{{ $errorMessage }}</h6>
                                <div class="divider"></div>
                            @endforeach
                        @endforeach
                    @endif
                </form>
                <div class="modal-footer">
                    <a class="modal-close waves-effect waves-green btn-flat red lighten-1 white-text">Cerrar</a>
                    <a wire:click='createChofer' class="btn pedimentoA1FormButton">CREAR</a>
                </div>
            </div>

        </div>

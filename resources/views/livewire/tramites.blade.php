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
                                @if (is_null($numEntrada))
                                    @foreach ($tramites['data'] as $tramite)
                                        <tr>
                                            <td>{{ $tramite['numEntrada'] }}</td>
                                            <td>{{ $tramite['factura'] }}</td>
                                            <td>{{ $tramite['pedimentoRT'] }}</td>
                                            <td>{{ $tramite['pedimentoA1'] }}</td>
                                            <td>{{ $tramite['cliente'] }}</td>
                                            <td>{{ $tramite['chofer'] }}</td>
                                            <td>{{ $tramite['placa'] }}</td>
                                            <td>{{ $tramite['economico'] }}</td>
                                            <td>{{ $tramite['candados'] }}</td>
                                            <td>{{ $tramite['numBultos'] }}</td>
                                            <td>{{ $tramite['barcode'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tramite['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($tramite['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='getPedimentoA1({{ $tramite['id'] }})'><i
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
                                            <td>{{ $tramite['placa'] }}</td>
                                            <td>{{ $tramite['economico'] }}</td>
                                            <td>{{ $tramite['candados'] }}</td>
                                            <td>{{ $tramite['numBultos'] }}</td>
                                            <td>{{ $tramite['barcode'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tramite['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($tramite['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='getPedimentoA1({{ $tramite['id'] }})'><i
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
                <h1>CREAR TRÁMITE</h1>
                <form>
                    <div class="row">
                      <div class="input-field col s6">
                        <!--Defer para que no se quite el character counter--->
                        <input id="numEntrada" type="number" wire:model.defer='dataTramite.numEntrada' class="validate" data-length="11">
                        <label for="numEntrada" class="active">Numero Entrada</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="apellido" type="text" class="validate">
                        <label for="apellido">Apellido</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="email" type="email" class="validate">
                        <label for="email">Correo electrónico</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="telefono" type="text" class="validate">
                        <label for="telefono">Teléfono</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="direccion" type="text" class="validate">
                        <label for="direccion">Dirección</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s4">
                        <input id="ciudad" type="text" class="validate">
                        <label for="ciudad">Ciudad</label>
                      </div>
                      <div class="input-field col s4">
                        <input id="estado" type="text" class="validate">
                        <label for="estado">Estado</label>
                      </div>
                      <div class="input-field col s4">
                        <input id="codigoPostal" type="text" class="validate">
                        <label for="codigoPostal">Código Postal</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="mensaje" class="materialize-textarea"></textarea>
                        <label for="mensaje">Mensaje</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit">Enviar</button>
                      </div>
                    </div>
                  </form>
            <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
            </div>
          </div>

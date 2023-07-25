<div>
    <div class="fondo">

        <!--CONTENEDOR CENTRAL DE LA PAGINA-->
        <div class="contenedorPedimentosA1">

            <!--CONTENEDOR DE BOTONES DE NAVEGACION ENTRE PEDIMENTOS-->
            <div class="navegacionTramites">
                <div class="row">
                    <a href="tramites" class="btn botonPedimentos" style="margin-right: 10px;">Tramites Pendientes</a>
                    <a href="tramitesRecogidos" id="tramitesNavegacion" class="btn botonPedimentos"
                        style="margin-left: 10px;"">Tramites Recogidos</a>

                    <!--SCRIPT QUE VERIFICA EN QUE URL ESTAMOS Y CAMBIA COLOR DE BOTON-->
                    <script>
                        getUbicacionBoton();

                        function getUbicacionBoton() {
                            // Obtener la URL actual
                            var url = window.location.href;
                            // Obtener el botón por su ID
                            var boton = document.getElementById('tramitesNavegacion');
                            // Verificar la URL y aplicar el color correspondiente al botón
                            if (url.includes('tramitesRecogidos')) {
                                boton.style.backgroundColor = '#E4DDDD';
                            }
                        }
                    </script>
                </div>
            </div>

            <!--CONTENEDOR DE BOTONES DE NAVEGACION ENTRE PEDIMENTOS-->
            <div class="fondoBuscarNumEntrada"></div>
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
                                    <th>Recogido</th>
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
                                            <td>{{ $tramite['pedimentoA1'] == 1111111 ? 'NA' : $tramite['pedimentoA1'] }}
                                            </td>
                                            <td>{{ $tramite['cliente'] }}</td>
                                            <td>{{ $tramite['chofer'] }}</td>
                                            <td>{{ $tramite['cellChofer'] == 0 ? 'NA' : $tramite['cellChofer'] }}</td>
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
                                                    wire:click='deleteTramite({{ $tramite['id'] }})'><i
                                                        class="large material-icons">delete</i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <!--SI SEMANA NO ES NULA MUESTRA LOS PEDIMENTOS A1 ENCONTRADO-->
                                    @foreach ($tramiteFound['data'] as $tramite)
                                        <tr>
                                            @if ($tramite['status'] == 1)
                                                <td>{{ $tramite['numEntrada'] }}</td>
                                                <td>{{ $tramite['factura'] }}</td>
                                                <td>{{ $tramite['pedimentoRT'] }}</td>
                                                <td>{{ $tramite['pedimentoA1'] == 1111111 ? 'NA' : $tramite['pedimentoA1'] }}
                                                </td>
                                                <td>{{ $tramite['cliente'] }}</td>
                                                <td>{{ $tramite['chofer'] }}</td>
                                                <td>{{ $tramite['cellChofer'] == 0 ? 'NA' : $tramite['cellChofer'] }}
                                                </td>
                                                <td>{{ $tramite['noLicenciaChofer'] }}</td>
                                                <td>{{ $tramite['placa'] }}</td>
                                                <td>{{ $tramite['economico'] }}</td>
                                                <td>{{ $tramite['candados'] }}</td>
                                                <td>{{ $tramite['numBultos'] }}</td>
                                                <td>{{ $tramite['barcode'] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($tramite['created_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                                </td>
                                                <td style="font-weight: bold">PENDIENTE RECOGER
                                                </td>
                                                <td style="display: flex">
                                                    <a class="btn btn-flat" style="margin: auto"
                                                        href="/tramite/{{ $tramite['id'] }}"><i
                                                            class="large material-icons">create</i></a>
                                                    <a class="btn btn-flat" style="margin: auto"
                                                        wire:click='deleteTramite({{ $tramite['id'] }})'><i
                                                            class="large material-icons">delete</i> </button>
                                                </td>
                                                @else
                                                <td>{{ $tramite['numEntrada'] }}</td>
                                                <td>{{ $tramite['factura'] }}</td>
                                                <td>{{ $tramite['pedimentoRT'] }}</td>
                                                <td>{{ $tramite['pedimentoA1'] == 1111111 ? 'NA' : $tramite['pedimentoA1'] }}
                                                </td>
                                                <td>{{ $tramite['cliente'] }}</td>
                                                <td>{{ $tramite['chofer'] }}</td>
                                                <td>{{ $tramite['cellChofer'] == 0 ? 'NA' : $tramite['cellChofer'] }}
                                                </td>
                                                <td>{{ $tramite['noLicenciaChofer'] }}</td>
                                                <td>{{ $tramite['placa'] }}</td>
                                                <td>{{ $tramite['economico'] }}</td>
                                                <td>{{ $tramite['candados'] }}</td>
                                                <td>{{ $tramite['numBultos'] }}</td>
                                                <td>{{ $tramite['barcode'] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($tramite['created_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                                </td>
                                                <td>{{\Carbon\Carbon::parse($tramite['updated_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm')}}</td>
                                                <td style="display: flex">
                                                    <a class="btn btn-flat" style="margin: auto"
                                                        href="/tramite/{{ $tramite['id'] }}"><i
                                                            class="large material-icons">create</i></a>
                                                    <a class="btn btn-flat" style="margin: auto"
                                                        wire:click='deleteTramite({{ $tramite['id'] }})'><i
                                                            class="large material-icons">delete</i> </button>
                                                </td>
                                            @endif
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
                            $totalPages = ceil($totalTramites / 7);
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

<div>
    <div class="fondo">

        <!--CONTENEDOR CENTRAL DE LA PAGINA-->
        <div class="contenedorPedimentosRT">

            <!--CONTENEDOR DE BOTONES DE NAVEGACION ENTRE PEDIMENTOS-->
            <div class="navegacionPedimentos">
                <div class="row">
                    <a href="pedimentosA1" id="pedimentosA1Navegacion" class="btn botonPedimentos"
                        style="margin-right: 10px;">PEDIMENTOS A1</a>
                    <a href="pedimentosRt" id="pedimentosRtNavegacion" class="btn botonPedimentos"
                        style="margin-left: 10px;"">PEDIMENTOS RT</a>

                    <!--SCRIPT QUE VERIFICA EN QUE URL ESTAMOS Y CAMBIA COLOR DE BOTON-->
                    <script>
                        getUbicacionBoton();

                        function getUbicacionBoton() {
                            // Obtener la URL actual
                            var url = window.location.href;
                            // Obtener el botón por su ID
                            var boton = document.getElementById('pedimentosRtNavegacion');
                            // Verificar la URL y aplicar el color correspondiente al botón
                            if (url.includes('pedimentosRt')) {
                                boton.style.backgroundColor = '#E4DDDD';
                            }
                        }
                    </script>
                </div>
            </div>

            <!--ROW QUE DIVIDE LA TABLA DEL FORMULARIO-->
            <div class="row center">
                <div class="col s12 m12 l8">
                    <!--INICIO TABLA-->
                    <div class="card-body bg-light" style="border-radius: 10px">
                        <table class="table white">
                            <thead>
                                <tr class="textos" style="background-color: #AD7A78; ">
                                    <th style="width: 15px">ID</th>
                                    <th>Semana</th>
                                    <th>Patente</th>
                                    <th>No. Pedimento</th>
                                    <th>Creado</th>
                                    <th>Actualizado</th>
                                    <th style="width: 80px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- VALIDA SI LA BUSQUEDA POR SEMANA ES NULA, SI LO ES MUESTRA TODOS LOS A1-->
                                @if (is_null($semana))
                                    @foreach ($pedimentosRT['data'] as $pedimentoRT)
                                        <tr>
                                            <td>{{ $pedimentoRT['id'] }}</td>
                                            <td>{{ $pedimentoRT['semana'] }}</td>
                                            <td>{{ $pedimentoRT['patente'] }}</td>
                                            <td>{{ $pedimentoRT['noPedimento'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoRT['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoRT['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='getPedimentoRT({{ $pedimentoRT['id'] }})'><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deletePedimentoRT({{ $pedimentoRT['id'] }})'><i
                                                        class="large material-icons">delete</i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <!--SI SEMANA NO ES NULA MUESTRA LOS PEDIMENTOS A1 ENCONTRADO-->
                                    @foreach ($pedimentosRTFound['data'] as $pedimentoRT)
                                        <tr>
                                            <td>{{ $pedimentoRT['id'] }}</td>
                                            <td>{{ $pedimentoRT['semana'] }}</td>
                                            <td>{{ $pedimentoRT['patente'] }}</td>
                                            <td>{{ $pedimentoRT['noPedimento'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoRT['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoRT['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='getPedimentoRT({{ $pedimentoRT['id'] }})'><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deletePedimentoRT({{ $pedimentoRT['id'] }})'><i
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
                            $totalPages = ceil($totalPedimentosRT / 10);
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

                <!--FORMULARIO CREACION DE PEDIMENTOS A1-->
                <div class="col s12 m12 l4">
                    <form wire:submit.prevent='createPedimentoRT'>
                        <div class="pedimentoRTForm center">
                            <br>
                            <!---BARRA BUSQUEDA-->
                            <div class="input-field campos">
                                <i class="material-icons prefix">search</i>
                                <input type="number" wire:model='semana' id="buscar">
                                <label for="buscar" class="active">Buscar por semana</label>
                            </div>
                            <h3 class="subtitulos">PEDIMENTOS RT</h3>
                            <div class="input-field campos">
                                <label class="active"
                                    for="semana">{{ $pedimentoRTToUpdate ? $pedimentoRTToUpdate['semana'] : 'Semana' }}</label>
                                <input wire:model='dataPedimentoRT.semana' id="semana" type="number">
                            </div>
                            <div class="input-field campos">
                                <input wire:model='dataPedimentoRT.patente' id="patente" type="number">
                                <label class="active"
                                    for="rfc">{{ $pedimentoRTToUpdate ? $pedimentoRTToUpdate['patente'] : 'Patente' }}</label>
                            </div>
                            <div class="input-field campos">
                                <label class="active"
                                    for="noPedimento">{{ $pedimentoRTToUpdate ? $pedimentoRTToUpdate['noPedimento'] : 'No. Pedimento' }}</label>
                                <input type="number" id="noPedimento" wire:model='dataPedimentoRT.noPedimento'>
                            </div>

                            <!--CREAR CLIENTE-->
                            <a wire:click='createPedimentoRT' class="btn pedimentoRTFormButton">CREAR</a>

                            <!--SI SE SELECCIONO UN CLIENTE PARA EDITAR, SE ACTIVAN LOS SIGUIENTES BOTONES-->
                            @if ($pedimentoRTToUpdate)
                                <a wire:click='updatePedimentoRT({{ $pedimentoRTToUpdate['id'] }})'
                                    class="btn pedimentoRTFormButton">ACTUALIZAR</a>
                                <a class="btn btn-flat" wire:click='cancelUpdate()'><i
                                        class="tiny material-icons home">do_not_disturb</i></a>
                            @endif

                            <!--SI LA API ARROJA UN ERROR ACTIVA UN MODAL-->
                            @if ($APIerrors)
                                <!--SI LOS ERRORES PERSISTEN SE MUESTRA EL MODAL, SINO DESAPARECE-->
                                <div class="showErrors" style="{{ $APIerrors ? 'display:inline;' : 'display:none;' }}">
                                    <!--CICLA LOS ERRORES PARA QUE LOS MUESTRE-->
                                    @foreach ($APIerrors as $field => $errors)
                                        <p class="subtitulos">
                                            @foreach ($errors as $error)
                                                {{ $field }}: {{ $error }}
                                            @endforeach
                                        </p>
                                        <br>
                                        <div class="divider"></div>
                                    @endforeach
                            @endif
                        </div>

                        <!--BOTON REGRESAR HOME-->
                        <div class="floatingActionButton right">
                            <a class="btn btn-flat" href="/"><i class="medium material-icons home">home</i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


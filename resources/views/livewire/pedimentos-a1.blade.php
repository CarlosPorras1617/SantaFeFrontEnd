<div>
    <div class="fondo">

        <!--CONTENEDOR CENTRAL DE LA PAGINA-->
        <div class="contenedorPedimentosA1">

            <!--CONTENEDOR DE BOTONES DE NAVEGACION ENTRE PEDIMENTOS-->
            <div class="navegacionPedimentos">
                <div class="row">
                    <a href="pedimentosA1" id="pedimentosA1Navegacion" class="btn botonPedimentos"
                        style="margin-right: 10px;">PEDIMENTOS A1</a>
                    <a href="pedimentosRt" class="btn botonPedimentos" style="margin-left: 10px;"">PEDIMENTOS RT</a>

                    <!--SCRIPT QUE VERIFICA EN QUE URL ESTAMOS Y CAMBIA COLOR DE BOTON-->
                    <script>
                        getUbicacionBoton();

                        function getUbicacionBoton() {
                            // Obtener la URL actual
                            var url = window.location.href;
                            // Obtener el botón por su ID
                            var boton = document.getElementById('pedimentosA1Navegacion');
                            // Verificar la URL y aplicar el color correspondiente al botón
                            if (url.includes('pedimentosA1')) {
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
                                    @foreach ($pedimentosA1['data'] as $pedimentoA1)
                                        <tr>
                                            <td>{{ $pedimentoA1['id'] }}</td>
                                            <td>{{ $pedimentoA1['semana'] }}</td>
                                            <td>{{ $pedimentoA1['patente'] }}</td>
                                            <td>{{ $pedimentoA1['noPedimento'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoA1['created_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoA1['updated_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='getPedimentoA1({{ $pedimentoA1['id'] }})'><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deletePedimentoA1({{ $pedimentoA1['id'] }})'><i
                                                        class="large material-icons">delete</i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <!--SI SEMANA NO ES NULA MUESTRA LOS PEDIMENTOS A1 ENCONTRADO-->
                                    @foreach ($pedimentosA1Found['data'] as $pedimentoA1)
                                        <tr>
                                            <td>{{ $pedimentoA1['id'] }}</td>
                                            <td>{{ $pedimentoA1['semana'] }}</td>
                                            <td>{{ $pedimentoA1['patente'] }}</td>
                                            <td>{{ $pedimentoA1['noPedimento'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoA1['created_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoA1['updated_at'])->tz('America/Hermosillo')->isoFormat('dddd D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='getPedimentoA1({{ $pedimentoA1['id'] }})'><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deletePedimentoA1({{ $pedimentoA1['id'] }})'><i
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
                            $totalPages = ceil($totalPedimentosA1 / 10);
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
                    <form wire:submit.prevent='createPedimentoA1'>
                        <div class="pedimentoA1Form center">
                            <br>
                            <!---BARRA BUSQUEDA-->
                            <div class="input-field campos">
                                <i class="material-icons prefix">search</i>
                                <input type="number" wire:model='semana' id="buscar">
                                <label for="buscar" class="active">Buscar por semana</label>
                            </div>
                            <h3 class="subtitulos">PEDIMENTOS A1</h3>
                            <div class="input-field campos">
                                <label class="active"
                                    for="semana">{{ $pedimentoA1ToUpdate ? $pedimentoA1ToUpdate['semana'] : 'Semana' }}</label>
                                <input wire:model.defer='dataPedimentoA1.semana' id="semana" type="number">
                            </div>
                            <div class="input-field campos">
                                <input wire:model.defer='dataPedimentoA1.patente' id="patente" type="number">
                                <label class="active"
                                    for="rfc">{{ $pedimentoA1ToUpdate ? $pedimentoA1ToUpdate['patente'] : 'Patente' }}</label>
                            </div>
                            <div class="input-field campos">
                                <label class="active"
                                    for="noPedimento">{{ $pedimentoA1ToUpdate ? $pedimentoA1ToUpdate['noPedimento'] : 'No. Pedimento' }}</label>
                                <input type="number" id="noPedimento" wire:model.defer='dataPedimentoA1.noPedimento'>
                            </div>

                            <!--CREAR CLIENTE-->
                            <a wire:click='createPedimentoA1' class="btn pedimentoA1FormButton">CREAR</a>

                            <!--SI SE SELECCIONO UN CLIENTE PARA EDITAR, SE ACTIVAN LOS SIGUIENTES BOTONES-->
                            @if ($pedimentoA1ToUpdate)
                                <a wire:click='updatePedimentoA1({{ $pedimentoA1ToUpdate['id'] }})'
                                    class="btn pedimentoA1FormButton">ACTUALIZAR</a>
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

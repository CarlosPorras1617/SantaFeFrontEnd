<div>
    <div class="fondo">
        <div class="contenedorPedimentosA1">
            <div class="row right">
                <div class="col s12 m12 l12">
                </div>
            </div>
            <div class="row center">
                <div class="col s12 m12 l8">
                    <!--INICIO-->
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
                                <!-- for each para los usuarios -->
                                @if (is_null($semana))
                                    @foreach ($pedimentosA1['data'] as $pedimentoA1)
                                        <tr>
                                            <td>{{ $pedimentoA1['id'] }}</td>
                                            <td>{{ $pedimentoA1['semana'] }}</td>
                                            <td>{{ $pedimentoA1['patente'] }}</td>
                                            <td>{{ $pedimentoA1['noPedimento'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoA1['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoA1['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
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
                                    @foreach ($pedimentosA1Found['data'] as $pedimentoA1)
                                        <tr>
                                            <td>{{ $pedimentoA1['id'] }}</td>
                                            <td>{{ $pedimentoA1['semana'] }}</td>
                                            <td>{{ $pedimentoA1['patente'] }}</td>
                                            <td>{{ $pedimentoA1['noPedimento'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoA1['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pedimentoA1['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
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
                                    <br>
                                    <br>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!--FIN-->
                    <ul class="pagination">
                        @php
                            //creamos cuantas divisiones tendra nuestro paginate diviendo el total de clientes / los mostrados en pantalla
                            $totalPages = ceil($totalPedimentosA1 / 10);
                        @endphp
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <!--creamos los botones en a los numeros de registros cada uno con la funcion de next pages y mandando la pagina a la que navegaremos-->
                            <li class="{{ $currentpage == $i ? 'active' : 'waves-effect' }}">
                                <a wire:click='nextsPages({{ $i }})' class="btn paginado"
                                    style="{{ $currentpage == $i ? 'color: #752E2B;' : 'color: #752E2B;' }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
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
                                <input wire:model='dataPedimentoA1.semana' id="semana" type="number">
                            </div>
                            <div class="input-field campos">
                                <input wire:model='dataPedimentoA1.patente' id="patente" type="number">
                                <label class="active"
                                    for="rfc">{{ $pedimentoA1ToUpdate ? $pedimentoA1ToUpdate['patente'] : 'Patente' }}</label>
                            </div>
                            <div class="input-field campos">
                                <label class="active"
                                    for="noPedimento">{{ $pedimentoA1ToUpdate ? $pedimentoA1ToUpdate['noPedimento'] : 'No. Pedimento' }}</label>
                                <input type="number" id="noPedimento" wire:model='dataPedimentoA1.noPedimento'>
                            </div>
                            <div class="">
                                <!--CREAR CLIENTE-->
                                <a wire:click='createPedimentoA1' class="btn pedimentoA1FormButton">CREAR</a>
                                @if ($pedimentoA1ToUpdate)
                                    <a wire:click='updatePedimentoA1({{ $pedimentoA1ToUpdate['id'] }})'
                                        class="btn pedimentoA1FormButton">ACTUALIZAR</a>
                                    <a class="btn btn-flat" wire:click='cancelUpdate()'><i
                                            class="tiny material-icons home">do_not_disturb</i></a>
                                @endif
                            </div>
                            @if ($APIerrors)
                            <div class="showErrors" style="{{$APIerrors ? 'display:inline;' : 'display:none;'}}">
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
                        <div class="floatingActionButton right">
                            <a class="btn btn-flat" href="/"><i class="medium material-icons home">home</i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


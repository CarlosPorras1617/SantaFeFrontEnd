<div>
    <div class="fondo">
        <div class="contenedorClientes">
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
                                    <th>Nombre</th>
                                    <th>RFC</th>
                                    <th>Creado</th>
                                    <th>Actualizado</th>
                                    <th style="width: 80px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- for each para los usuarios -->
                                @if (empty($nombreEmpresa))
                                    @foreach ($clients['data'] as $client)
                                        <tr>
                                            <td>{{ $client['id'] }}</td>
                                            <td>{{ $client['nombre'] }}</td>
                                            <td>{{ $client['rfc'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($client['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($client['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='getClient({{ $client['id'] }})'><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deleteClient({{ $client['id'] }})'><i
                                                        class="large material-icons">delete</i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($clientsFound['data'] as $client)
                                        <tr>
                                            <td>{{ $client['id'] }}</td>
                                            <td>{{ $client['nombre'] }}</td>
                                            <td>{{ $client['rfc'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($client['created_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($client['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
                                            </td>
                                            <td style="display: flex">
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='getClient({{ $client['id'] }})'><i
                                                        class="large material-icons">create</i></a>
                                                <a class="btn btn-flat" style="margin: auto"
                                                    wire:click='deleteClient({{ $client['id'] }})'><i
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
                            $totalPages = ceil($totalClients / 10);
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
                    <form wire:submit.prevent='createClient'>
                        <div class="clienteForm center">
                            <br>
                            <!---BARRA BUSQUEDA-->
                            <div class="input-field campos">
                                <i class="material-icons prefix">search</i>
                                <input type="text" wire:model='nombreEmpresa' id="buscar">
                                <label for="buscar" class="active">Buscar por nombre</label>
                            </div>
                            <h3 class="subtitulos">CLIENTE</h3>
                            <div class="input-field campos">
                                <label class="active"
                                    for="nombre">{{ $clientToUpdate ? $clientToUpdate['nombre'] : 'Nombre' }}</label>
                                <input wire:model='dataClient.nombre' id="nombre" type="text">
                            </div>
                            <div class="input-field campos">
                                <input wire:model='dataClient.rfc' id="rfc" type="text"
                                    value="{{ $clientToUpdate ? $clientToUpdate['rfc'] : ' ' }}">
                                <label class="active"
                                    for="rfc">{{ $clientToUpdate ? $clientToUpdate['rfc'] : 'RFC' }}</label>
                            </div>
                            <div class="clientesFormButtonRow">
                                <!--CREAR CLIENTE-->
                                <a wire:click='createClient' class="btn clienteFormButton">CREAR</a>
                                @if ($clientToUpdate)
                                    <a wire:click='updateClient({{ $clientToUpdate['id'] }})'
                                        class="btn clienteFormButton">ACTUALIZAR</a>
                                    <a class="btn btn-flat" wire:click='cancelUpdate()'><i
                                            class="tiny material-icons home">do_not_disturb</i></a>
                                @endif
                            </div>
                            @if (array_key_exists('message', $APIerrors))
                                <div class="divider"></div>
                                <p class="subtitulos">{{ $APIerrors['message'] }}</p>
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

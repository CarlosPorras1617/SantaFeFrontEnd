<div>
    <div class="fondo">
        <div class="contenedorClientes">
            <div class="row right">
                <div class="col s12 m12 l12">
                    <h1>Barra busqueda</h1>
                </div>
            </div>
            <div class="row center">
                <div class="col s12 m12 l8">
                    <!--INICIO-->

                    <div class="card-body bg-light" style="border-radius: 10px">
                        <table class="table white">
                            <thead>
                                <tr
                                    style="background-color: #AD7A78; font-family: 'Arial'; font-size: 28px; text-align:center">
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
                                @foreach ($clients['data'] as $client)
                                    <tr style="font-family: 'monospace'; font-size: 18px; text-align:center">
                                        <td>{{ $client['id'] }}</td>
                                        <td>{{ $client['nombre'] }}</td>
                                        <td>{{ $client['rfc'] }}</td>
                                        <td>{{ $client['created_at'] }}</td>
                                        <td>{{ $client['updated_at'] }}</td>
                                        <td style="list-style: none; display: flex">
                                            <a class="btn btn-flat" style="margin: auto"><i
                                                    class="large material-icons">create</i></a>
                                            <a class="btn btn-flat" style="margin: auto"
                                                wire:click='deleteClient({{ $client['id'] }})'"><i
                                                    class="large material-icons">delete</i> </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <br>
                                <br>
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
                            <li class="{{ $currentpage == $i ? 'active red' : 'waves-effect' }}">
                                <a wire:click='nextsPages({{ $i }})' class="btn paginado"
                                    style="{{ $currentpage == $i ? 'color: #752E2B;' : 'color: #752E2B;' }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>

                    </ul>


                </div>
                <div class="col s12 m12 l4">
                    <div class="clienteForm center">
                        <h3 class="subtitulos">CLIENTE</h3>
                        <div class="input-field campos">
                            <input id="nombre" type="text" class="validate">
                            <label for="Nombre">Nombre</label>
                        </div>
                        <div class="input-field campos">
                            <input id="rfc" type="text" class="validate">
                            <label for="rfc">RFC</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

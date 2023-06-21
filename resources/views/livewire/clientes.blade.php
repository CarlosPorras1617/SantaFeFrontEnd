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
                                <tr style="font-family: 'Arial'; font-size: 28px; text-align:center">
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
                                @foreach ($clients as $client)
                                    <tr style="font-family: 'monospace'; font-size: 18px; text-align:center">
                                        <td>{{ $client['id'] }}</td>
                                        <td>{{ $client['nombre'] }}</td>
                                        <td>{{ $client['rfc'] }}</td>
                                        <td>{{ $client['created_at'] }}</td>
                                        <td>{{ $client['updated_at'] }}</td>
                                        <td style="list-style: none; display: flex">
                                            <a  class="btn btn-flat" style="margin: auto"><i class="large material-icons">create</i></a>
                                            <a  class="btn btn-flat" style="margin: auto" href="clientes/{{$client['id']}}"><i class="large material-icons">delete</i> </button>
                                        </td>
                                        <!-- <td>$cliente['facturas']['Nombre'][0]</td> -->
                                    </tr>
                                @endforeach
                                <br>
                                <br>
                            </tbody>
                        </table>
                    </div>

                    <!--FIN-->
                </div>
                <div class="col s12 m12 l4">
                    <h1>Formulario</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="contenedorChofer">
        <img class="imagenChofer" src="{{ asset('images/chofer.jpeg') }}">
    </div>
    <div class="row">
        <div class="col s12 m6 center">
            <h1 class="bienvenido flow-text">Bienvenido a DRI-COS</h1>
        </div>
    </div>
    <div class="contenidoHome center">
        <h1 class="titulos">INICIA TU TRÁMITE</h1>
        <div class="row">
            <a href="/choferes" class="col s12 m6 l3">
                <div class="row cards">
                    <div class="card">
                        <div class="card-image">
                            <img class="card-image" src="{{ asset('images/choferes-card.jpeg') }}">
                        </div>
                        <h3 class="subtitulos">CHOFERES</h3>
                        <div class="card-content">
                            <p class="textos">
                                Agrega, modifica, consulta o elimina
                                los distintos choferes para tus
                                trámites.
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="pedimentosA1" class="col s12 m6 l3">
                <div class="row cards">
                    <div class="card">
                        <div class="card-image">
                            <img class="card-image" src="{{ asset('images/pedimentos-card.jpeg') }}">
                        </div>
                        <h3 class="subtitulos">PEDIMENTOS</h3>
                        <div class="card-content">
                            <p class="textos">
                                Agrega, modifica, consulta o elimina
                                los distintos pedimentos semanales.
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a class="col s12 m6 l3" href="clientes">
                <div class="row cards">
                    <div class="card">
                        <div class="card-image">
                            <img class="card-image" src="{{ asset('images/clientes-card.jpeg') }}">
                        </div>
                        <h3 class="subtitulos">CLIENTES</h3>
                        <div class="card-content">
                            <p class="textos">
                                Agrega, modifica, consulta o elimina
                                los distintos clientes de la agencia.
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a class="col s12 m6 l3" href="tramites">
                <div class="row cards">
                    <div class="card">
                        <div class="card-image">
                            <img class="card-image" src="{{ asset('images/tramites-card.jpeg') }}">
                        </div>
                        <h3 class="subtitulos">TRÁMITES</h3>
                        <div class="card-content">
                            <p class="textos">
                                Agrega, modifica, consulta o elimina
                                los distintos trámites.
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <h1 class="titulos">CONSULTA</h1>
        <h3 class="textos">Consulta el estatus de tus trámites</h3>
        <div class="row">
            <div class="container">
                <div class="col s10 m10 l10">
                    <form>
                        <div class="input-field col s8 cards ">
                            <input wire:model='numEntrada' type="number" id="numero" data-length="11">
                            <label for="numero">Numero de Entrada</label>
                        </div>
                        <a href="#" class="icon-link modal-trigger" wire:click='searchTramite'>
                            <i class="material-icons prefix">search</i>
                        </a>
                    </form>
                </div>
                <div class="row">
                    <div class="col s3 m3 l3">
                        <p id="numEntrada"></p>
                    </div>
                    <div class="col s3 m3 l3">
                        <p id="chofer"></p>
                    </div>
                    <div class="col s3 m3 l3">
                        <p id="creado"></p>
                    </div>
                    <div class="col s3 m3 l3">
                        <p id="actualizado"></p>
                    </div>
                </div>
                <div id="botonBuscarOtro"></div>
            </div>
        </div>
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">ACCESOS DIRECTOS</h5>
                        <p class="grey-text text-lighten-4">Navegación rapida a los apartados del sistema</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Links</h5>
                        <ul>
                            <li><a class="grey-text text-lighten-3" href="#!">CHOFERES</a></li>
                            <li><a class="grey-text text-lighten-3" href="#!">CONSULTAR TRAMITES</a></li>
                            <li><a class="grey-text text-lighten-3" href="#!">CLIENTES</a></li>
                            <li><a class="grey-text text-lighten-3" href="#!">CREAR TRÁMITE</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2023 SANTA FE - TODOS LOS DERECHOS RESERVADOS
                </div>
            </div>
        </footer>
    </div>
</div>


<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cargando', function(cargando) {

            function formatTimestamp(timestamp) {
                /*const dateObj = new Date(timestamp);

                function getMonthName(monthNumber) {
                    const monthNames = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                    return monthNames[monthNumber - 1];
                }

                function formatNumber(number) {
                    return number < 10 ? `0${number}` : number;
                }

                const year = dateObj.getFullYear();
                const month = dateObj.getMonth() + 1;
                const day = dateObj.getDate();
                const hours = dateObj.getHours();
                const minutes = dateObj.getMinutes();
                const seconds = dateObj.getSeconds();

                return `${day} de ${getMonthName(month)} de ${year}, ${formatNumber(hours)}:${formatNumber(minutes)}:${formatNumber(seconds)}`;*/
                const dateObj = new Date(timestamp);

                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric',
                };

                return dateObj.toLocaleString(undefined, options);
            }


            const fechaCreacion = formatTimestamp(cargando.created_at);
            const fechaDeRecogido = formatTimestamp(cargando.updated_at);
            //verificar si vino por el tramite
            if (cargando.status == 1) {
                actualizado.innerHTML = '<h5>Actualizado</h5><br>' + 'Pendiente';
            }
            if (cargando.status == 0) {
                actualizado.innerHTML = '<h5>Estatus</h5><br>' + 'Recogido <br>' + fechaDeRecogido;
            }


            // Ejecutar la función que desees aquí, o mostrar un mensaje
            botonBuscarOtro = document.getElementById('botonBuscarOtro');
            numEntrada = document.getElementById('numEntrada');
            chofer = document.getElementById('chofer');
            creado = document.getElementById('creado');
            actualizado = document.getElementById('actualizado');
            numEntrada.innerHTML = '<h5>Num. Entrada:</h5><br>' + cargando.numEntrada;
            chofer.innerHTML = '<h5>Chofer:</h5><br>' + cargando.chofer;
            creado.innerHTML = '<h5>Trámite Creado</h5><br>' + fechaCreacion;
            botonBuscarOtro.innerHTML = '<a class="btn pedimentoRTFormButton" href="/">BUSCAR OTRO</a>'
            console.log(cargando);
        });
    });
</script>

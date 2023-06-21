<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Home" />
    <meta name="keywords" content="Home" />

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!--css navbar-->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    <!--css HomePage-->
    <link rel="stylesheet" href="{{ asset('css/homePage.css') }}">
    <!--css HomePage-->
    <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">

    <!--icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-secondary">
    <div>
        <aside id="fh5co-aside" role="complementary" class="js-fullheight bg-warning">
            <nav class="white">
                <div class="nav-wrapper center">
                <div class="contenedorTriagulo">
                    <div class="triangulo"></div>
                </div>
                  <img class="brand-logo center" src="{{asset('images/AgenciaSantaFeLogo.png')}}">
                  <div class="contenedor">
                  <ul class="right hide-on-med-and-down list">
                    <li><a  class="large material-icons">local_shipping</a></li>
                    <li><a  class="large material-icons">assignment</a></li>
                    <li><a  class="large material-icons" href="clientes">people</a></li>
                    <li><a  class="large material-icons">add</a></li>
                  </ul>
                </div>
                </div>
              </nav>

            <div class="fh5co-footer">

            </div>

        </aside>

        <div id="fh5co-main">
            <aside class="container">
                {{$slot}}
            </aside>

    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
          $('input#numero').characterCounter();
        });
    </script>
</body>
</html>

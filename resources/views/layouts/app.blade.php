<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Macuin Dashboards') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/jefe/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cliente/showTickets.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forms.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-custom shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/cliente') }}">
                    <b>{{ config('app.name', 'Macuin Dashboards') }}</b>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        <!--@if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif -->
    @else
        <!-- Tickets Dropdown -->
        <li class="nav-item dropdown">
            <a id="ticketsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tickets
            </a>
            <div class="dropdown-menu" aria-labelledby="ticketsDropdown">
                <a class="dropdown-item" href="{{ url('/ticketCliente/create') }}">Crear</a>
                <a class="dropdown-item" href="{{ url('/ticketCliente') }}">Mis tickets</a>
            </div>
        </li>

        <!-- Administrar Perfil Dropdown -->
        <li class="nav-item dropdown">
            <a id="profileManagementDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administrar perfil
            </a>
            <div class="dropdown-menu" aria-labelledby="profileManagementDropdown">
                <!--<a class="dropdown-item" href="{{ url('/perfilCliente') }}">Modificar datos</a>-->
                <a class="dropdown-item" href="{{ route('vistaCambioContra') }}">Editar Perfil</a>
            </div>
        </li>

        <!-- User Account Dropdown -->
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->Nombre }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Cerrar sesión') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>

                </div>
            </div>
        </nav>

        @if(session('mensaje'))
        <div class="alert alert-{{ session('mensaje')['tipo'] == 'success' ? 'success' : 'danger' }}">
            {{ session('mensaje')['texto'] }}
        </div>
        @endif
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <div id="spinnerContainer" style="display: none;" class="text-center">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script>
        function showSpinners() {
            document.getElementById('spinnerContainer').style.display = 'block';
        }
    </script>

<script>
        $(document).ready(function() {
            var idTicketGlobal; // Variable global para mantener el ID del ticket

            $('#comentModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                idTicketGlobal = button.data('id'); // Guarda el ID del ticket globalmente

                cargarComentarios(idTicketGlobal);
            });

            // Evento para enviar mensaje al hacer clic en el botón
            $('#enviarMensaje').click(function() {
                enviarMensaje();
            });

            // Evento para enviar mensaje al presionar la tecla ENTER
            $('#mensajeInput').keypress(function(e) {
                if (e.which == 13) { // 13 = código de la tecla ENTER
                    enviarMensaje();
                    e.preventDefault(); // Evitar el comportamiento por defecto del formulario (Esto podría recargar la página)
                }
            });

            function enviarMensaje() {
                var mensaje = $('#mensajeInput').val();
                if (mensaje.trim() != "") {
                    $.ajax({
                        url: '/comentarios/crear',
                        type: 'POST',
                        data: {
                            ID_tickets: idTicketGlobal,
                            comentario: mensaje,
                            _token: "{{ csrf_token() }}" 
                        },
                        success: function() {
                            $('#mensajeInput').val(''); // Limpiar el campo de entrada
                            cargarComentarios(idTicketGlobal); // Recargar los comentarios
                        }
                    });
                }
            }

            function cargarComentarios(idTicket) {
                $.ajax({
                    url: '/comentarios/ticket/' + idTicket,
                    type: 'GET',
                    success: function(response) {
                        var comentarios = response.comentarios;
                        var usuarioAutenticado = response.usuarioAutenticado;
                        var comentariosHtml = '';
                        var currentFecha = null;

                        comentarios.forEach(function(comentario) {
                            var fecha = comentario.fecha_hora.substr(0, 10);
                            var hora = comentario.fecha_hora.substr(11);
                            if (fecha !== currentFecha) {
                                if (currentFecha !== null) comentariosHtml += '</ul>';
                                comentariosHtml += '<div class="chat-date">' + fecha + '</div><ul>';
                                currentFecha = fecha;
                            }
                            var clase = comentario.ID_Usuario === usuarioAutenticado ? 'out' : 'in';
                            var avatar = comentario.fotoPerfil;
                            comentariosHtml += '<li class="' + clase + '"><div class="chat-img"><img alt="Avatar" src="' + avatar + '" class="img-fluid rounded-circle" style="object-fit: cover; width: 40px; height: 40px; border-radius: 50%;"></div><div class="chat-body"><div class="chat-message"><h5>' + comentario.Nombre + ' <small>' + hora + '</small></h5><p>' + comentario.comentario + '</p></div></div></li>';
                        });

                        $('.chat-list').html(comentariosHtml + '</ul>');
                    }
                });
            }
        });
    </script>
</body>
</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Distribuciones El Mago</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Custom CSS -->
    <style>
        @font-face {
            font-family: 'Metropolis-Bold';
            src: url('/fonts/Metropolis-Bold.ttf') format('truetype');
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Metropolis-Bold', sans-serif;

        }

        .site-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            /* Asegura que ocupe toda la altura de la ventana */
        }

        .site-container>main {
            flex-grow: 1;
            /* Hace que el contenido principal crezca para ocupar el espacio disponible */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: white;
        }
        .content-wrapper {
            flex-grow: 1;
            overflow-y: auto; /* Permite el scroll vertical si es necesario */
            padding-bottom: 80px; /* Altura del footer para evitar solapamiento */
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light" style=" background-color: rgb(2, 35, 58)">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="max-width: 70px; margin: 0% 1%">
            <a class="navbar-brand text-white" href="{{route('home')}}" style="font-size: 25px;">Distribuciones EL Mago</a>
            <button class="navbar-toggler" style="background-color: rgb(172, 172, 172); margin-right: 3%" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-lg-5 me-md-5 me-sm-5">
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Registro') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item active">
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa-solid fa-user"></i> {{ __('Personas') }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" "text-dark" href="{{ route('supplier.index') }}">{{ __('Proveedores') }}</a>
                            <a class="dropdown-item" "text-dark" href="{{ route('employee.index') }}">{{ __('Empleados') }}</a>
                            {{--  <a class="dropdown-item" "text-dark" href="{{ route('user.index') }}">{{ __('Usuarios') }}</a>  --}}
                            <a class="dropdown-item" "text-dark" href="{{route('customer.index')}}">{{__('Clientes')}}</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('product.index') }}"><i class="fa-solid fa-folder-open"></i>{{ __('Productos') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('truck_type.index') }}"><i class="fa-solid fa-truck-front"></i>{{ __('Tipo de Camion') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('load.index')}}"><i class="fa-solid fa-truck-arrow-right"></i>{{__('Carga')}}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa-solid fa-road"></i> {{ __('Rutas') }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" text-dark" href="{{ route('route.index') }}">{{ __('Generar Rutas') }}</a>
                            <a class="dropdown-item" "text-dark" href="{{ route('departament.index') }}">{{ __('Departamentos') }}</a>
                            <a class="dropdown-item" text-dark" href="{{ route('municipality.index') }}">{{ __('Municipios') }}</a>
                        </div>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('sale.index') }}"> <i class="fa-solid fa-sack-dollar"></i>{{__('Ventas')}}</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('purchase.index') }}"> <i class="fa-solid fa-money-bill-trend-up"></i>{{__('Compras')}}</a>
                    </li> 
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesion') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
        <br>
        <br>
        <br>
        <footer class="footer">
            <div class="d-flex flex-wrap justify-content-between align-items-center py-2 px-4 my-2 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <img src="{{asset('img/logo.png')}}" alt="Logo" style="max-width: 30px;margin: 0% 4%">
                    </a>
                    <span class="text-muted">&copy; 2024 Distribuciones el Mago, Diseñado por <b>Developer Programer</b></span>
                </div>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex ">
                    <li class="ms-3"><a class="text-muted" tooltip="tooltip" title="Twitter" href="#"><i class="fa-brands fa-x-twitter fa-xl"></i></a></li>
                    <li class="ms-3"><a class="text-muted" tooltip="tooltip" title="Instagram" href="#"><i class="fa-brands fa-instagram fa-xl"></i></a></li>
                    <li class="ms-3"><a class="text-muted" tooltip="tooltip" title="facebook" href="#"><i class="fa-brands fa-facebook fa-xl"></i></a></li>
                </ul>
            </div>
        </footer>
    </div>
    @yield('script')
    <script src="https://cdn.userway.org/widget.js" data-account="m6oj1qPLRj"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  --}}


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
    <!-- Script para alternar la visibilidad de la contraseña -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.querySelector('#password');
            const togglePassword = document.querySelector('.toggle-password');
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
            });
        });
    </script>
</body>

</html>
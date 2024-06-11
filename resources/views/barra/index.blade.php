 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Sidebars · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{asset('css/sidebars.css')}}" rel="stylesheet">
  </head>
  <body>
        
 <h1 class="visually-hidden">Sidebars examples</h1>

  <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      
      <span class="fs-4">MENÚ</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">{{ __('Dasboard') }}</a>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('supplier.index') }}">{{ __('Proveedores') }}</a>
        </a>
      </li>
      <li>
        <a class="nav-link" href="{{ route('product.index') }}">{{ __('Productos') }}</a>
        </a>
      </li>
      <li>
        <a class="nav-link" href="{{ route('truck_type.index') }}">{{ __('Tipo de Camion') }}</a>
        </a>
      </li>
      <li>
        <a class="nav-link" href="{{route('customer.index')}}">{{__('Clientes')}}</a>
        </a>
      </li>
      <li>
        <a class="nav-link" href="{{route('load.index')}}">{{__('Carga')}}</a>
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">

        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="#">Configuracion</a></li>
        <li><a class="dropdown-item" href="#">Perfil</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href=""{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"">Cerrar Sesion</a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"></li>
      </ul>
    </div>
  </div>
  </body>
 
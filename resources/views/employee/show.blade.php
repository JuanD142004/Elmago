@extends('layouts.app')

@section('template_title')
    {{ $employee->name ?? __('Mostrar') . " " . __('Empleado') }}
@endsection

@section('content')
<br>
    <style>
        body {
            background-image: url('/img/El_mago.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            width: 100vw;
        }
        .card {
        background-color: rgba(255, 255, 255, 0.8);
        /* Cambiar el valor de 0.8 para ajustar la opacidad */
    }
    </style>
<body>
<section class="content container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <div class="card-header text-black d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Empleado: {{ $employee->user->name }}</h5>
                    <a class="btn btn-light" href="{{ route('employee.index') }}">{{ __('Volver') }}</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Usuario:</strong>
                            <p class="text-muted">{{ $employee->user->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Correo Registrado:</strong>
                            <p class="text-muted">{{ $employee->user->email }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Nombres:</strong>
                            <p class="text-muted">{{ $employee->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Apellidos:</strong>
                            <p class="text-muted">{{ $employee->surname }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Género:</strong>
                            <p class="text-muted">{{ $employee->gender }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Estado Civil:</strong>
                            <p class="text-muted">{{ $employee->civil_status }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>EPS:</strong>
                            <p class="text-muted">{{ $employee->eps }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Teléfono:</strong>
                            <p class="text-muted">{{ $employee->phone }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Hijos:</strong>
                            <p class="text-muted">{{ $employee->children }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Dirección:</strong>
                            <p class="text-muted">{{ $employee->home }}</p>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <strong>Ruta Asignada:</strong>
                            <p class="text-muted">{{ $employee->route->route_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
</body>
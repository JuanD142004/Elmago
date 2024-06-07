@extends('layouts.app')

@section('template_title')
{{ $sale->name ?? __("Mostrar Venta") }}
@endsection

@section('content')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body{
            background-image: url('/img/El_mago.jpg');
            background-size: cover; /* Ajusta la imagen para que cubra todo el fondo */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed;
            height: 100vh; /* Ajusta la altura al 100% de la ventana */
            width: 100vw; /* Ajusta el ancho al 100% de la ventana */
            overflow-x: hidden; /* Evita el desbordamiento horizontal */
        }


        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
            border: none; /* Sin bordes para la tarjeta */
        }

        .table {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
        }
        .card {
            width: 100%;
            margin: auto;
        }

        .card-header h4 {
            font-size: 1.5rem;
        }

        .btn-primary {
            font-size: 1.2rem;
        }

        .table th,
        .table td {
            font-size: 1.1rem;
        }

        .alert {
            font-size: 1.1rem;
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        h5 {
            font-size: 1.3rem;
        }

        .details-table-container {
            margin-top: 20px;
        }

        .table-details th,
        .table-details td {
            padding: 15px;
        }
    </style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h4 class="m-0">{{ __("Mostrar Venta") }}</h4>
                    <a class="btn btn-primary mb-3 float-right" href="{{ route('sales.index') }}">
                        <i class="fas fa-chevron-left"></i> {{ __("Atrás") }}
                    </a>
                </div>

                <div class="card-body">
                    @if (!$sale->enabled)
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <div>
                            <strong>{{ __("¡Atención!") }}</strong> {{ __("Esta venta ha sido cancelada.") }}
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <h5>{{ __('Detalles de la Venta') }}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>{{ __("Cliente") }}</th>
                                            <td><strong>{{ $sale->customer->id }}</strong> - {{ $sale->customer->customer_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Total Precio") }}</th>
                                            <td>{{ $sale->price_total }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Método de Pago") }}</th>
                                            <td>{{ $sale->payment_method }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <h5>{{ __('Detalles de Productos') }}</h5>
                            <div class="table-responsive details-table-container">
                                <table class="table table-striped table-bordered table-details">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __("Producto") }}</th>
                                            <th>{{ __("Precio Unitario") }}</th>
                                            <th>{{ __("Cantidad") }}</th>
                                            <th>{{ __("Descuento") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sale->detailsSales as $index => $detailsSale)
                                        <tr class="{{ $index % 2 === 0 ? 'even' : 'odd' }}">
                                            <td>{{ $detailsSale->product->product_name ?? 'N/A' }}</td>
                                            <td>{{ $detailsSale->price_unit }}</td>
                                            <td>{{ $detailsSale->amount }}</td>
                                            <td>{{ $detailsSale->discount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- End of row -->
                </div> <!-- End of card body -->
            </div> <!-- End of card -->
        </div> <!-- End of col-md-12 -->
    </div> <!-- End of row -->
</div> <!-- End of container -->

@endsection
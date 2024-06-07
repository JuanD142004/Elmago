@extends('layouts.app')

@section('template_title')
{{ $purchase->name ?? __('Mostrar') . " " . __('Compra') }}
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

        .alert {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .details-table-container {
            margin-top: 20px;
        }

        .table-details th,
        .table-details td {
            padding: 15px;
        }



        .card {
            width: 100%;
            margin: auto;
        }

        .card-header h4 {
            font-size: 1.5rem;
        }

        .alert {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
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
                    <h4 class="m-0">{{ __("Mostrar Compra") }}</h4>
                    <a class="btn btn-primary mb-3 float-right" href="{{ route('purchase.index') }}">
                        <i class="fas fa-chevron-left"></i> {{ __("Atrás") }}
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>{{ __('Detalles de la Compra') }}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>{{ __("Nombre del Proveedor") }}</th>
                                            <td>{{ $purchase->supplier->supplier_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Fecha") }}</th>
                                            <td>{{ $purchase->date }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Valor Total") }}</th>
                                            <td>{{ $purchase->total_value }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("Número de Factura") }}</th>
                                            <td>{{ $purchase->num_bill }}</td>
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
                                            <th>{{ __("Nombre del Producto") }}</th>
                                            <th>{{ __("Lote de Compra") }}</th>
                                            <th>{{ __("Cantidad") }}</th>
                                            <th>{{ __("Valor Unitario") }}</th>
                                            <th>{{ __("ID de Compra") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailsPurchases as $index => $detailsPurchase)
                                        <tr class="{{ $index % 2 === 0 ? 'even' : 'odd' }}">
                                            <td>{{ $detailsPurchase->product->product_name ?? 'N/A' }}</td>
                                            <td>{{ $detailsPurchase->purchase_lot }}</td>
                                            <td>{{ $detailsPurchase->amount }}</td>
                                            <td>{{ $detailsPurchase->unit_value }}</td>
                                            <td>{{ $detailsPurchase->purchases_id }}</td>
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

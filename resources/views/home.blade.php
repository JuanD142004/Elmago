@extends('layouts.app')

@section('content')
    <br>
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.css') }}">
    <title>Inicio</title>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Panel Administrativo') }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-danger text-uppercase mb-1">
                                                    Proveedor con más compras</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                                    @if ($proveedorConMasCompras)
                                                        <p>{{ $proveedorConMasCompras->supplier_name }} - Número de compras:
                                                            {{ $proveedorConMasCompras->purchases_count }}</p>
                                                    @else
                                                        <p>No hay compras registradas.</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-user-group fa-2xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="font-weight-bold text-success text-uppercase mb-1">
                                                    Total de Ventas Hoy</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                                    {{ '$' . $totalVentasHoy }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-sack-dollar fa-2xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Ventas realizadas hoy
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h4 mb-0 mr-3 font-weight-bold text-gray-800">
                                                            {{ 'N°' . $cantidadVentasHoy }}
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col">
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-info" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-wallet fa-2xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="font-weight-bold text-warning text-uppercase mb-1">
                                                    Producto más vendido</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                                    @if ($productoConMasVentasDetalles)
                                                        <p>{{ $productoConMasVentasDetalles->product_name }} - Total de
                                                            ventas: {{ $productoConMasVentas->total_amount }}</p>
                                                    @else
                                                        <p>No hay ventas registradas.</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-money-check-dollar fa-2xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-style calendar-card mb-30">
                                  <div id="calendar-mini"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>Compras Proveedores</h3>
                                
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Proveedor</th>
                                                <th>Fecha</th>
                                                <th>Valor Total</th>
                                                <th>Número de Factura</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($comprasHoy->isEmpty())
                                                <p style="color: red">No hay compras registradas hoy.</p>
                                            @else
                                            @foreach ($comprasHoy as $compra)
                                                <tr>
                                                    <td>{{ $compra->supplier->supplier_name }}</td>
                                                    <td>{{ $compra->date }}</td>
                                                    <td>${{ $compra->total_value }}</td>
                                                    <td>{{ $compra->num_bill }}</td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    {{ $comprasHoy->links() }}
                                
                            </div>
                            <div class="col-lg-6">
                                <h3>Ventas Realizadas</h3>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Proveedor</th>
                                                <th>Fecha</th>
                                                <th>Valor Total</th>
                                                <th>Número de Factura</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($ventasHoy->isEmpty())
                                                <p style="color: red">No hay ventas registradas hoy.</p>
                                            @else
                                                @foreach ($ventasHoy as $venta)
                                                    <tr>
                                                        <td>{{ $venta->customer->customer_name }}</td>
                                                        <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                                                        <td>${{ $venta->price_total }}</td>
                                                        <td>{{ $venta->payment_method }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    {{ $ventasHoy->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

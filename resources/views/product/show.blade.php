@extends('layouts.app')

@section('template_title')
    {{ $product->name ?? __('Show') . " " . __('Product') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Product</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('product.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre del Producto:</strong>
                            {{ $product->product_name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Marca:</strong>
                            {{ $product->brand }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Precio unitario:</strong>
                            {{ $product->price_unit }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Unidad de medida:</strong>
                            {{ $product->unit_of_measurement }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Proveedores Id:</strong>
                            {{ $product->suppliers_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

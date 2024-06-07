@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Product
@endsection

@section('content')
<br>
<section class="content container-fluid">
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Crear') }} Producto Nuevo</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('product.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('product.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

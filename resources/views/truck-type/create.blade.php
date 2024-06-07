@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Truck Type
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Tipo de Camión</span>
                        
                    </div>
                    <!-- Aquí va el resto del contenido del formulario -->
               

                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('truck_type.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('truck-type.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

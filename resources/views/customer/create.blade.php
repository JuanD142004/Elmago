@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Customer
@endsection

@section('content')
<br>
<section class="content container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Cliente</span>
                                
                    </div>
                <div class="card-body bg-white">
                    {{-- Mostrar la alerta de error si existe --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('customer.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        
                        @include('customer.form', ['routes' => $routes])

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.app')

@section('template_title')
    {{ __('Editar') }} Tipo de Camión
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">

                <div class="card card-default">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="card-title">{{ __('Editar') }} Tipo de Camión</span>
                             
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('truck_type.update', $truckType->id) }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('truck-type.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

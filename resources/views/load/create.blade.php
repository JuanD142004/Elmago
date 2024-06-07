@extends('layouts.app')

@section('template_title')
    {{ __('Crear') }} Carga
@endsection

@section('content')
<br>    
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Carga</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('loads.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('load.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
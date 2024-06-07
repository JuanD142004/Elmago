@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Route
@endsection

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12"style="display: flex; justify-content: center;">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Ruta</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('route.update', $route->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('route.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

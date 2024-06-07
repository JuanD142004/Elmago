@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Supplier
@endsection

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Proveedor</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('supplier.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('supplier.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

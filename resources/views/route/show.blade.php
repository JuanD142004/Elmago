@extends('layouts.app')

@section('template_title')
    {{ $route->name ?? __('Show') . " " . __('Route') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Route</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('route.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Route Name:</strong>
                            {{ $route->route_name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Departament Id:</strong>
                            {{ $route->departament_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

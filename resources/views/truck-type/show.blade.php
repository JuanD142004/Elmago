@extends('layouts.app')

@section('template_title')
    {{ $truckType->name ?? __('Show') . " " . __('Truck Type') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Truck Type</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('truck_type.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Truck Brand:</strong>
                            {{ $truckType->truck_brand }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Plate:</strong>
                            {{ $truckType->plate }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Ability:</strong>
                            {{ $truckType->ability }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Enabled:</strong>
                            {{ $truckType->enabled }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

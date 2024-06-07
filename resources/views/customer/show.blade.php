@extends('layouts.app')

@section('template_title')
    {{ $customer->name ?? __('Show') . " " . __('Customer') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Customer</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('customer.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Customer Name:</strong>
                            {{ $customer->customer_name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Company Name:</strong>
                            {{ $customer->company_name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Location:</strong>
                            {{ $customer->location }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cell Phone:</strong>
                            {{ $customer->cell_phone }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Mail:</strong>
                            {{ $customer->mail }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Routes Id:</strong>
                            {{ $customer->routes_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Enabled:</strong>
                            {{ $customer->enabled }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
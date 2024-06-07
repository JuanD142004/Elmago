@extends('layouts.app')

@section('template_title')
    {{ $supplier->name ?? __('Show') . " " . __('Supplier') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Supplier</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('supplier.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nit:</strong>
                            {{ $supplier->nit }}
                        </div>
                        <div class="form-group">
                            <strong>Supplier Name:</strong>
                            {{ $supplier->supplier_name }}
                        </div>
                        <div class="form-group">
                            <strong>Cell Phone:</strong>
                            {{ $supplier->cell_phone }}
                        </div>
                        <div class="form-group">
                            <strong>Mail:</strong>
                            {{ $supplier->mail }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $supplier->address }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

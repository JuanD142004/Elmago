@extends('layouts.app')

@section('template_title')
    {{ $detailsPurchase->name ?? __('Show') . " " . __('Details Purchase') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Details Purchase</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('details_purchase.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Products Id:</strong>
                            {{ $detailsPurchase->products_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Purchase Lot:</strong>
                            {{ $detailsPurchase->purchase_lot }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Amount:</strong>
                            {{ $detailsPurchase->amount }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Unit Value:</strong>
                            {{ $detailsPurchase->unit_value }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Purchases Id:</strong>
                            {{ $detailsPurchase->purchases_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="form-group mb-2 mb20">
            {{ Form::label('products_id', __('Products Id'), ['class' => 'form-label']) }}
            {{ Form::select('products_id', $products->pluck('product_name', 'id'), null, ['class' => 'form-control' . ($errors->has('products_id') ? ' is-invalid' : ''), 'placeholder' => __('Select Product')]) }}
            {!! $errors->first('products_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            {{ Form::label('purchase_lot', __('Purchase Lot'), ['class' => 'form-label']) }}
            {{ Form::text('purchase_lot', old('purchase_lot', $detailsPurchase?->purchase_lot), ['class' => 'form-control' . ($errors->has('purchase_lot') ? ' is-invalid' : ''), 'placeholder' => 'Purchase Lot']) }}
            {!! $errors->first('purchase_lot', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            {{ Form::label('amount', __('Amount'), ['class' => 'form-label']) }}
            {{ Form::text('amount', old('amount', $detailsPurchase?->amount), ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'Amount']) }}
            {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            {{ Form::label('unit_value', __('Unit Value'), ['class' => 'form-label']) }}
            {{ Form::text('unit_value', old('unit_value', $detailsPurchase?->unit_value), ['class' => 'form-control' . ($errors->has('unit_value') ? ' is-invalid' : ''), 'placeholder' => 'Unit Value']) }}
            {!! $errors->first('unit_value', '<div class="invalid-feedback">:message</div>') !!}
        </div>

       
    </div>
    <div class="col-md-12 mt20 mt-2">
        {{ Form::submit(__('Agregar nuevo detalle'), ['class' => 'btn btn-primary', 'id' => 'addNewProduct']) }}
    </div>
</div>

    <style>
        body {
                background-image: url('/img/El_mago.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                height: 100vh;
                width: 100vw;
            }

            .card {
                background-color: rgba(255, 255, 255, 0.7);
                border: none;
                padding: 20px;
                margin: 20px;
                border-radius: 8px;
            }

            .form-container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
            }

            .form-container .form-group {
                display: flex;
                flex-direction: column;
            }

            .box-footer {
                display: flex;
                justify-content: flex-start;
                gap: 10px;
                margin-top: 20px;
            }
    </style>

<div class="box box-info padding-1">
    <div class="box-body">
    <div class="container">
        <div class="form-group">
            <label for="product_name">{{ __('Nombre del Producto') }}</label>
            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name', $product?->product_name) }}" id="product_name" placeholder="Nombre del Producto">
            {!! $errors->first('product_name', '<div class="invalid-feedback">El Nombre del producto es Obligatorio</div>') !!}
        </div>
        <div class="form-group">
            <label for="brand">{{ __('Marca') }}</label>
            <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand', $product?->brand) }}" id="brand" placeholder="Marca">
            {!! $errors->first('brand', '<div class="invalid-feedback">La Marca es Obligatoria</div>') !!}
        </div>
        <div class="form-group">
            <label for="price_unit">{{ __('Precio unitario') }}</label>
            <input type="text" name="price_unit" class="form-control @error('price_unit') is-invalid @enderror" value="{{ old('price_unit', $product?->price_unit) }}" id="price_unit" placeholder="Precio unitario">
            {!! $errors->first('price_unit', '<div class="invalid-feedback">Este campo es Obligatorio</div>') !!}
        </div>
        <script>
            document.getElementById('price_unit').addEventListener('input', function(event) {
                let value = event.target.value;
                value = value.replace(/[^\d.,]/g, '');
                value = formatCurrency(value);
                event.target.value = value;
            });

            function formatCurrency(value) {
                let number = parseFloat(value.replace(/[,.]/g, '').replace(',', '.'));
                if (!isNaN(number)) {
                    number = Math.max(0, Math.min(number, 1000000000));
                    return number.toLocaleString('es-CO', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 });
                } else {
                    return '';
                }
            }
        </script>
        <div class="form-group">
            <label for="unit_of_measurement">{{ __('Unidad de Medida') }}</label>
            <select name="unit_of_measurement" class="form-control @error('unit_of_measurement') is-invalid @enderror" id="unit_of_measurement">
                <option value="">Selecciona la Unidad de Medida</option>
                <option value="Tonelada" {{ old('unit_of_measurement', $product?->unit_of_measurement) == 'Tonelada' ? 'selected' : '' }}>Tonelada(1000kg)</option>
                <option value="Bulto" {{ old('unit_of_measurement', $product?->unit_of_measurement) == 'Bulto' ? 'selected' : '' }}>Bulto(40kg)</option>
                <option value="Kilogramo" {{ old('unit_of_measurement', $product?->unit_of_measurement) == 'Kilogramo' ? 'selected' : '' }}>Kilogramo</option>
                <1option value="Libra" {{ old('unit_of_measurement', $product?->unit_of_measurement) == 'Libra' ? 'selected' : '' }}>Libra</1option>
                <option value="Caja" {{ old('unit_of_measurement', $product?->unit_of_measurement) == 'Caja' ? 'selected' : '' }}>Caja(25Kg)</option>
            </select>
            {!! $errors->first('unit_of_measurement', '<div class="invalid-feedback">Selecciona una Unidad de Medida</div>') !!}
        </div>
        <div class="form-group">
            <label for="suppliers_id">{{ __('Proveedor') }}</label>
            <select name="suppliers_id" class="form-control @error('suppliers_id') is-invalid @enderror" id="suppliers_id">
                <option value="">Selecciona el Proveedor</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('suppliers_id', $product?->suppliers_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_name }}</option>
                @endforeach
            </select>
            {!! $errors->first('suppliers_id', '<div class="invalid-feedback">Selecciona un proveedor</div>') !!}
        </div>
    </div>
        <br>
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
            <a href="{{ route('product.index') }}" class="btn btn-primary">{{ __('Volver') }}</a>
        </div>
    </div>
</div>

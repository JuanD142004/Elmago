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
                    <label for="product_name_and_brand">{{ __('Nombre y marca del Producto') }}</label>
                    <input type="text" name="product_name_and_brand" class="form-control @error('product_name_and_brand') is-invalid @enderror" value="{{ old('product_name_and_brand', $product->product_name_and_brand) }}" id="product_name_and_brand" placeholder="Introduzca el Nombre del Producto">
                    {!! $errors->first('product_name_and_brand', '<div class="invalid-feedback">El Nombre del producto es Obligatorio</div>') !!}
                </div>
                <div class="form-group">
                    <label for="product_description">{{ __('Descripcion') }}</label>
                    <input type="text" name="product_description" class="form-control @error('product_description') is-invalid @enderror" value="{{ old('product_description', $product->product_description) }}" id="product_description" placeholder="Dijite la descripcion del producto">
                    {!! $errors->first('product_description', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                
                <div class="form-group">
                    <label for="price_unit">{{ __('Precio unitario') }}</label>
                    <input type="text" name="price_unit" class="form-control @error('price_unit') is-invalid @enderror" value="{{ old('price_unit', $product->price_unit) }}" id="price_unit" placeholder="Precio unitario">
                    {!! $errors->first('price_unit', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}              
                  </div>
                
                <div class="form-group">
                    <label for="stock">{{ __('Stock') }}</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock ?? 0) }}" id="stock" placeholder="Ingrese la cantidad de existencias" readonly>
                    {!! $errors->first('stock', '<div class="invalid-feedback">Este campo es Obligatorio</div>') !!}
                </div>
                
                <div class="form-group">
                    <label for="suppliers_id">{{ __('Proveedor') }}</label>
                    <select name="suppliers_id" class="form-control @error('suppliers_id') is-invalid @enderror" id="suppliers_id">
                        <option value="">Selecciona el Proveedor</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('suppliers_id', $product->suppliers_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('suppliers_id', '<div class="invalid-feedback">Selecciona un proveedor</div>') !!}
                </div>
            </div>
            <br>
            <div class="box-footer mt20">
                <button type="submit" class="btn btn-primary" id="submit-btn">{{ __('Enviar') }}</button>
                <a href="{{ route('product.index') }}" class="btn btn-primary">{{ __('Volver') }}</a>
            </div>
            </div>
            </div>
            
            <script>
                // Restaurar valores del formulario al cargar la página
                document.addEventListener('DOMContentLoaded', function() {
                    const inputs = document.querySelectorAll('input, select');
            
                    inputs.forEach(input => {
                        const value = localStorage.getItem(input.id);
                        if (value !== null) {
                            if (input.type === 'checkbox') {
                                input.checked = JSON.parse(value);
                            } else {
                                input.value = value;
                            }
                        }
                        
                        input.addEventListener('input', function() {
                            if (input.type === 'checkbox') {
                                localStorage.setItem(input.id, input.checked);
                            } else {
                                localStorage.setItem(input.id, input.value);
                            }
                        });
                    });
                });
            
                // Limpiar almacenamiento local al enviar el formulario solo si se hace clic en el botón de enviar
                document.getElementById('submit-btn').addEventListener('click', function() {
                    localStorage.clear();
                });
            
                // Script para formatear el precio unitario
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
            
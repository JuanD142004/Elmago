<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Mejorado</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body{
            background-image: url('/img/El_mago.jpg');
            background-size: cover; /* Ajusta la imagen para que cubra todo el fondo */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed;
            height: 100vh; /* Ajusta la altura al 100% de la ventana */
            width: 100vw; /* Ajusta el ancho al 100% de la ventana */
            overflow-x: hidden; /* Evita el desbordamiento horizontal */
        }


        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
            border: none; /* Sin bordes para la tarjeta */
        }

        .table {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
        }
        .form-container {
            margin: auto;
            margin-top: 20px;
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .remove-product-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 32px;
            width: 32px;
            border: none;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .remove-product-btn:hover {
            background-color: #c82333;
        }

        .remove-product-btn i {
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <h2>Formulario de Venta</h2>
                        <!-- Primer formulario -->
                        <form id="mainForm" action="{{ route('sales.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                {{ Form::label('customers_id', 'Nombre del Cliente') }}
                                {{ Form::select('customers_id', $customers->pluck('customer_name', 'id'), null, ['class' => 'form-control' . ($errors->has('customers_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un cliente']) }}
                                {!! $errors->first('customers_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                {{ Form::label('price_total', 'Precio Total') }}
                                {{ Form::text('price_total', old('price_total'), ['class' => 'form-control' . ($errors->has('price_total') ? ' is-invalid' : ''), 'placeholder' => 'Precio Total', 'readonly' => 'readonly']) }}
                                {!! $errors->first('price_total', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                {{ Form::label('payment_method', 'Método de Pago') }}
                                {{ Form::select('payment_method', [
                                    '' => 'Selecciona un método de pago',
                                    'Efectivo' => 'Efectivo',
                                    'Transferencia' => 'Transferencia',
                                    'Crédito' => 'Crédito'
                                ], null, ['class' => 'form-control' . ($errors->has('payment_method') ? ' is-invalid' : '')]) }}
                                {!! $errors->first('payment_method', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group btn-container">
                                <button type="button" id="submitButton" class="btn btn-success btn-enviar" onclick="enviarDetalles()">
                                    {{ __('Enviar') }}
                                </button>
                                <a class="btn btn-primary" href="{{ route('sales.index') }}">
                                    <i class="fas fa-chevron-left"></i> {{ __("Atrás") }}
                                </a>
                            </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 form-container">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <h2>Formulario de Detalles de Venta</h2>
                        <!-- Segundo formulario como tabla -->

                        @csrf
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID del Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedProductsBody">
                                    <tr class="product-row-template">
                                        <td>
                                            {{ Form::select('products_id[]', $products->pluck('product_name', 'id'), null, ['class' => 'form-control products-id', 'placeholder' => 'Selecciona un producto']) }}
                                            {!! $errors->first('products_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </td>
                                        <td>
                                            {{ Form::text('price_unit[]', null, ['class' => 'form-control price-unit', 'readonly' => 'readonly']) }}
                                        </td>
                                        <td>
                                            {{ Form::text('amount[]', null, ['class' => 'form-control amount', 'placeholder' => 'Cantidad', 'oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")']) }}
                                            {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
                                        </td>
                                        <td>
                                            {{ Form::text('discount[]', null, ['class' => 'form-control discount', 'placeholder' => 'Descuento', 'oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")']) }}
                                            {!! $errors->first('discount', '<div class="invalid-feedback">:message</div>') !!}
                                        </td>
                                        <td>
                                            {{ Form::text('total_price[]', null, ['class' => 'form-control total-price', 'readonly' => 'readonly']) }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-product-btn d-none">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer mt20">
                            <button type="button" class="btn btn-primary" id="addProductBtn">Agregar Producto</button>
                            <!-- <a class="btn btn-primary" href="{{ route('details_sale.index') }}">
                                    <i class="fas fa-chevron-left"></i> {{ __("Atrás") }}
                                </a> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const products = @json($products);

        function updatePriceUnit(selectElement) {
            const selectedProductId = selectElement.value;
            const selectedProduct = products.find(product => product.id == selectedProductId);
            const priceUnitInput = selectElement.closest('tr').querySelector('.price-unit');
            let priceUnitInPesos = 0;

            if (selectedProduct) {
                const priceString = selectedProduct.price_unit.replace(/\D/g, '');
                priceUnitInPesos = parseFloat(priceString);
            }

            if (isNaN(priceUnitInPesos)) {
                priceUnitInput.value = '';
            } else {
                const formattedPrice = '$' + new Intl.NumberFormat('es-CO').format(priceUnitInPesos);
                priceUnitInput.value = formattedPrice;
            }
            updateTotal(selectElement.closest('tr'));
        }

        function updateTotal(row) {
            const priceUnitInput = row.querySelector('.price-unit');
            const amountInput = row.querySelector('.amount');
            const discountInput = row.querySelector('.discount');
            const totalPriceInput = row.querySelector('.total-price');

            const priceUnit = parseFloat(priceUnitInput.value.replace(/\D/g, ''));
            const amount = parseFloat(amountInput.value) || 0;
            const discount = parseDiscount(discountInput.value);

            if (isNaN(priceUnit) || isNaN(amount) || isNaN(discount)) {
                totalPriceInput.value = '';
            } else {
                let totalInPesos = (priceUnit * amount) - discount;
                totalInPesos = Math.round(totalInPesos);

                const formattedTotal = '$' + new Intl.NumberFormat('es-CO').format(totalInPesos);
                totalPriceInput.value = formattedTotal;
            }
            updatePriceTotal();
        }

        function parseDiscount(discountString) {
            const discountNumber = parseFloat(discountString.replace(/\D/g, ''));

            if (isNaN(discountNumber)) {
                return 0;
            } else {
                return discountNumber;
            }
        }

        function toggleRemoveButton(selectElement) {
            const row = selectElement.closest('tr');
            const removeButton = row.querySelector('.remove-product-btn');
            removeButton.classList.remove('d-none');
        }

        function addRemoveButtonHandler(row) {
            if (!row.classList.contains('product-row-template')) {
                row.querySelector('.remove-product-btn').addEventListener('click', function() {
                    row.remove();
                    updatePriceTotal();
                });
            }
        }

        function updatePriceTotal() {
            const totalPrices = document.querySelectorAll('.total-price');
            let totalPriceSum = 0;
            totalPrices.forEach(input => {
                const totalPrice = parseFloat(input.value.replace(/\D/g, ''));
                if (!isNaN(totalPrice)) {
                    totalPriceSum += totalPrice;
                }
            });

            totalPriceSum = Math.round(totalPriceSum);

            const formattedTotalPrice = '$' + new Intl.NumberFormat('es-CO').format(totalPriceSum);
            const priceTotalInput = document.getElementById('price_total');
            priceTotalInput.value = formattedTotalPrice;
        }

        document.querySelectorAll('.products-id').forEach(select => {
            select.addEventListener('change', function() {
                updatePriceUnit(this);
                toggleRemoveButton(this);
            });
        });

        document.querySelectorAll('.amount, .discount').forEach(input => {
            input.addEventListener('input', function() {
                let value = this.value.trim();

                if (value === '-') {
                    this.value = '';
                    return;
                }

                if (value.startsWith('-')) {
                    value = value.substring(1);
                    this.value = value;
                }

                if (this.classList.contains('discount') && value === '') {
                    this.value = '$';
                    return;
                }

                updateTotal(this.closest('tr'));
            });
        });

        document.getElementById('addProductBtn').addEventListener('click', function() {
            const tableBody = document.getElementById('selectedProductsBody');
            const templateRow = tableBody.querySelector('.product-row-template');
            const newRow = templateRow.cloneNode(true);
            newRow.classList.remove('product-row-template');
            tableBody.appendChild(newRow);

            newRow.querySelectorAll('input, select').forEach(input => {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });

            newRow.querySelector('.products-id').addEventListener('change', function() {
                updatePriceUnit(this);
                toggleRemoveButton(this);
            });

            newRow.querySelectorAll('.amount, .discount').forEach(input => {
                input.addEventListener('input', function() {
                    let value = this.value.trim();

                    if (value === '-') {
                        this.value = '';
                        return;
                    }

                    if (value.startsWith('-')) {
                        value = value.substring(1);
                        this.value = value;
                    }

                    updateTotal(newRow);
                });
            });

            addRemoveButtonHandler(newRow);
        });

        const initialRow = document.querySelector('.product-row-template');
        addRemoveButtonHandler(initialRow);
    });

    function enviarDetalles() {
        const detalles = [];
        const customerId = document.querySelector('select[name="customers_id"]').value;
        const priceTotal = document.querySelector('input[name="price_total"]').value.replace(/[^\d]/g, ''); // Remover formateo
        const paymentMethod = document.querySelector('select[name="payment_method"]').value;

        document.querySelectorAll('select[name^="products_id"]').forEach((select, index) => {
            const productId = select.value;
            const priceUnit = document.querySelectorAll('input[name^="price_unit"]')[index].value.replace(/[^\d]/g, ''); // Remover formateo
            const amount = document.querySelectorAll('input[name^="amount"]')[index].value;
            const discount = document.querySelectorAll('input[name^="discount"]')[index].value.replace(/[^\d]/g, ''); // Remover formateo

            detalles.push({
                products_id: productId,
                price_unit: priceUnit,
                amount: amount,
                discount: discount
            });
        });

        const data = {
            customers_id: customerId,
            price_total: priceTotal,
            payment_method: paymentMethod,
            detalles: detalles
        };

        // Perform the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('sales.store') }}",
            data: {
                _token: '{{ csrf_token() }}',
                data: data
            },
            success: function(response) {
                console.log(response);
                window.location.href = "{{ route('sales.index') }}";
            },
            error: function(err) {
                console.error(err);
            }
        });
    }
</script>

</body>

</html>
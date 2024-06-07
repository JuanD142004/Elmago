<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Carga</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('/img/El_mago.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            width: 100vw;
            overflow-x: hidden; /* Evita el desbordamiento horizontal */
        }
         .card {
            background-color: rgba(255, 255, 255, 0.8);
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

        
        .form-container {
            margin: auto;
            margin-top: 20px;
        }

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
            <div class="col-md-8">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <h2>Formulario de Carga</h2>
                        <form id="loadForm" method="POST">
                            @csrf
                            <td>
                                <div class="form-group">
                                    <label for="date">{{ __('Fecha') }}</label>
                                    {{ Form::text('date', old('date', optional($load->date)->format('Y-m-d')), ['class' => 'form-control ' . ($errors->has('date') ? 'is-invalid' : ''), 'id' => 'date', 'placeholder' => 'Fecha']) }}
                                    {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <label for="routes_id">{{ __('Ruta') }}</label>
                                    {{ Form::select('routes_id', $routes->pluck('route_name', 'id'), old('routes_id', optional($load)->routes_id), ['class' => 'form-control ' . ($errors->has('routes_id') ? 'is-invalid' : ''), 'id' => 'routes_id', 'placeholder' => 'Selecciona la ruta']) }}
                                    {!! $errors->first('routes_id', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <label for="truck_types_id">{{ __('Tipo de Camión') }}</label>
                                    {{ Form::select('truck_types_id', $truckTypes->pluck('truck_brand', 'id'), old('truck_types_id', optional($load)->truck_types_id), ['class' => 'form-control ' . ($errors->has('truck_types_id') ? 'is-invalid' : ''), 'id' => 'truck_types_id', 'placeholder' => 'Selecciona el tipo de camión']) }}
                                    {!! $errors->first('truck_types_id', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </td>

                            <div class="form-group btn-container">
                                <button type="submit" class="btn btn-success">{{ __('Enviar') }}</button>
                                <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-container">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <h2>Detalles de la Carga</h2>
                        <form id="detailsForm">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Cantidad') }}</th>
                                            <th>{{ __('ID de Producto') }}</th>
                                            <th>{{ __('Acciones') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="productos">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    {{ Form::text('amount[]', old('amount'), ['class' => 'form-control ' . ($errors->has('amount') ? 'is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
                                                    {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    {{ Form::select('products_id[]', $products->pluck('product_name', 'id'), old('products_id'), ['class' => 'form-control ' . ($errors->has('products_id') ? 'is-invalid' : ''), 'placeholder' => 'Selecciona el producto']) }}
                                                    {!! $errors->first('products_id', '<div class="invalid-feedback">:message</div>') !!}
                                                </div>
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
                                <button type="button" class="btn btn-primary" id="agregarProducto">Agregar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
    flatpickr('#date', {
        dateFormat: 'Y-m-d',
        defaultDate: 'today',
        minDate: 'today',
        allowInput: true,
        clickOpens: true,
        onClose: function(selectedDates, dateStr, instance) {
            if (selectedDates.length && selectedDates[0].getDate() !== new Date().getDate()) {
                instance.setDate('today', true);
            }
        }
    });

    document.getElementById('agregarProducto').addEventListener('click', function() {
        const nuevaFila = document.createElement('tr');

        nuevaFila.innerHTML = `
            <td>
                <div class="form-group">
                    <input type="text" name="amount[]" class="form-control" placeholder="Amount">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select name="products_id[]" class="form-control">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-product-btn">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;

        document.querySelector('.productos').appendChild(nuevaFila);
    });

    document.querySelector('.productos').addEventListener('click', function(event) {
        if (event.target.closest('.remove-product-btn')) {
            event.target.closest('tr').remove();
        }
    });

    document.querySelector('form[action="{{ route('loads.store') }}"]').addEventListener('submit', function(event) {
        event.preventDefault();
        enviarDetalles();
    });

    function enviarDetalles() {
        const detalles = [];
        const date = document.querySelector('input[name="date"]').value;
        const routes_id = document.querySelector('select[name="routes_id"]').value;
        const truck_types_id = document.querySelector('select[name="truck_types_id"]').value;

        document.querySelectorAll('.productos tr').forEach(function(detalle) {
            const amount = detalle.querySelector('input[name^="amount"]').value;
            const products_id = detalle.querySelector('select[name^="products_id"]').value;

            if (amount && products_id) {
                detalles.push({
                    amount: amount,
                    products_id: products_id
                });
            }
        });

        const data = {
            date: date,
            routes_id: routes_id,
            truck_types_id: truck_types_id,
            detalles: detalles
        };

        fetch("{{ route('loads.store') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(response => {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'La carga se ha guardado correctamente.'
                }).then(() => {
                    window.location.href = "{{ route('loads.index') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.error || 'Hubo un problema al guardar la carga.'
                });
            }
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al guardar la carga.'
            });
            console.error(err);
        });
    }
});

    </script>
   
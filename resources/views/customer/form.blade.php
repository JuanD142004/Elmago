
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Comic Sans MS</title>
    
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
                background-color: rgba(255, 255, 255, 0.7); /* Fondo translúcido */
                padding: 20px; /* Espaciado interno */
                border-radius: 8px; /* Bordes redondeados */
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
</head>
<body>
<div class="row padding-1 p-1">
    <div class="box-body">
        <div class="form-container">
            <div class="form-group">
                <label for="customer_name" class="form-label">{{ __('Nombre del cliente') }}</label>
                <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', optional($customer)->customer_name) }}" id="customer_name" placeholder="Nombre del cliente">
                {!! $errors->first('customer_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group">
                <label for="company_name" class="form-label">{{ __('Nombre de la empresa') }}</label>
                <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', optional($customer)->company_name) }}" id="company_name" placeholder="Nombre de la empresa">
                {!! $errors->first('company_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group">
                <label for="location" class="form-label">{{ __('Dirección') }}</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', optional($customer)->location) }}" id="location" placeholder="Dirección">
                {!! $errors->first('location', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group">
                <label for="cell_phone" class="form-label">{{ __('Celular') }}</label>
                <input type="text" name="cell_phone" class="form-control @error('cell_phone') is-invalid @enderror" value="{{ old('cell_phone', optional($customer)->cell_phone) }}" id="cell_phone" placeholder="Celular">
                {!! $errors->first('cell_phone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group">
                <label for="mail" class="form-label">{{ __('Correo') }}</label>
                <input type="text" name="mail" class="form-control @error('mail') is-invalid @enderror" value="{{ old('mail', optional($customer)->mail) }}" id="mail" placeholder="Correo">
                {!! $errors->first('mail', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <!-- Campo para seleccionar la ruta -->
            <div class="form-group">
                <label for="routes_id" class="form-label">{{ __('Id Ruta') }}</label>
                <select name="routes_id" class="form-control @error('routes_id') is-invalid @enderror" id="routes_id">
                    <option value="">Select Route</option>
                    @foreach($routes as $route)
                        <option value="{{ $route->id }}" {{ optional($customer->route)->id == $route->id ? 'selected' : '' }}>{{ $route->route_name }}</option>
                    @endforeach
                </select>
                {!! $errors->first('routes_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <!-- Agregar campo "enabled" -->
            <div class="form-group">
                <label for="enabled" class="form-label">{{ __('Habilitado') }}</label>
                <select name="enabled" class="form-control @error('enabled') is-invalid @enderror" id="enabled">
                    <option value="1" {{ old('enabled', optional($customer)->enabled ?? '') == 1 ? 'selected' : '' }}>1</option>
                </select>
                {!! $errors->first('enabled', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <br>

            
        
        </div>
    </div>
</div>
<br>
<div class="form-group btn-container">
    <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
        <a href="{{ route('customer.index') }}" class="btn btn-primary" style="background-color: #007bff; color: #fff;">
            <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
        </a>
</div>
</body>
</html>
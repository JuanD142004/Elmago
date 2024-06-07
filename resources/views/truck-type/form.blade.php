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
                <label for="truck_brand" class="form-label">{{ __('Marca de Camión') }}</label>
                <input type="text" name="truck_brand" class="form-control @error('truck_brand') is-invalid @enderror" value="{{ old('truck_brand', $truckType?->truck_brand) }}" id="truck_brand" placeholder="Marca de Camión">
                {!! $errors->first('truck_brand', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group">
                <label for="plate" class="form-label">{{ __('Placa') }}</label>
                <input type="text" name="plate" class="form-control @error('plate') is-invalid @enderror" value="{{ old('plate', $truckType?->plate) }}" id="plate" placeholder="Placa">
                {!! $errors->first('plate', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group">
                <label for="ability" class="form-label">{{ __('Capacidad') }}</label>
                <input type="text" name="ability" class="form-control @error('ability') is-invalid @enderror" value="{{ old('ability', $truckType?->ability) }}" id="ability" placeholder="Capacidad">
                {!! $errors->first('ability', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="form-group">
                <label for="enabled" class="form-label">{{ __('Enabled') }}</label>
                <select name="enabled" class="form-control @error('enabled') is-invalid @enderror" id="enabled">
                    <option value="1" {{ old('enabled', $truckType?->enabled) == '1' ? 'selected' : '' }}>1</option>
                </select>
                {!! $errors->first('enabled', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            
        </div>
    </div>
</div>
<div class="form-group btn-container">
                <button type="submit" class="btn btn-primary me-2">{{ __('Enviar') }}</button>
                <a href="{{ route('truck_type.index') }}" class="btn btn-primary" style="background-color: #007bff; color: #fff;">
                    <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                </a>
            </div>
</body>
</html>
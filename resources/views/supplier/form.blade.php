<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario en Dos Filas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
</head>
<body></body>
<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="nit">{{ __('Nit') }}</label>
            <input type="text" name="nit" class="form-control @error('nit') is-invalid @enderror" value="{{ old('nit', $supplier->nit) }}" id="nit" placeholder="Nit">
            {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="supplier_name">{{ __('Nombre Proveedor') }}</label>
            <input type="text" name="supplier_name" class="form-control @error('supplier_name') is-invalid @enderror" value="{{ old('supplier_name', $supplier->supplier_name) }}" id="supplier_name" placeholder="Nombres y Apellidos">
            {!! $errors->first('supplier_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="cell_phone">{{ __('Telefono') }}</label>
            <input type="text" name="cell_phone" class="form-control @error('cell_phone') is-invalid @enderror" value="{{ old('cell_phone', $supplier->cell_phone) }}" id="cell_phone" placeholder="Telefono">
            {!! $errors->first('cell_phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="mail">{{ __('Correo Electronico') }}</label>
            <input type="text" name="mail" class="form-control @error('mail') is-invalid @enderror" value="{{ old('mail', $supplier->mail) }}" id="mail" placeholder="Mail">
            {!! $errors->first('mail', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="address">{{ __('Direccion') }}</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $supplier->address) }}" id="address" placeholder="Ubicacion y direccion">
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
<br>
    </div>
    <div class="form-group btn-container">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
        <a href="{{ route('supplier.index') }}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> {{ __('Volver') }}</a>

    </div>
</div>
</body>

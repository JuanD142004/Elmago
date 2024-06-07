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
<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="form-group mb-2 mb20">
            <label for="route_name" class="form-label">{{ __('Nombre de la Ruta') }}</label>
            <input type="text" name="route_name" class="form-control @error('route_name') is-invalid @enderror" value="{{ old('route_name') }}" id="route_name" placeholder="Nombre">
            {!! $errors->first('route_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group">
            <label for="departament_id">{{ __('Departamento') }}</label>
            <select id="departament" name="departament_id" class="form-select @error('departament_id') is-invalid @enderror" arial-label="Default select example">
                <option value="">Selecciona el Departamento</option>
                @foreach($departaments as $departament)
                    <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                @endforeach
            </select>  
            @error('departament_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="municipality_id">{{ __('Municipio') }}</label>
            <select id="municipalities" name="municipalities[]" class="form-select select2-multiple @error('municipalities') is-invalid @enderror" aria-label="Default select example" multiple>
                <option value="">Selecciona el Municipio</option>
            </select>
            
            @error('municipalities')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
        <a href="{{ route('route.index') }}" class="btn btn-primary">{{ __('Volver') }}</a>
    </div>
</div>
@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const departament = document.getElementById('departament');
    const municipalities = document.getElementById('municipalities');

    const getMunicipalities = async (departaments_id) => {
        const response = await fetch(`/route/create/departament/${departaments_id}/municipalities`);
        const data = await response.json();

        let options = '';
        data.forEach(element => {
            options += `<option value="${element.name}">${element.name}</option>`;
        });
        municipalities.innerHTML = options;
    }

    // Inicializa Select2 aquí
    $(document).ready(function() {
        $('#municipalities').select2({
            placeholder: "Selecciona el Municipio",
            allowClear: true,
            tags: false
        }).on('change', function() {
            // Manejar cambios en las opciones seleccionadas
        });
    });

    window.onload = () => {
        const departaments_id = departament.value;
        getMunicipalities(departaments_id);
    };

    departament.addEventListener('change', (e) => {
        getMunicipalities(e.target.value);
    });
});


</script>
<script>
$(document).ready(function() {
    $('#municipalities').select2({
        placeholder: "Selecciona el Municipio",
        allowClear: true,
        tags: false // Evita que los usuarios ingresen sus propias opciones
    }).on('change', function() {
        // Manejar cambios en las opciones seleccionadas
    });
});


</script>   
@endsection
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario en Dos Filas</title>
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
</head>
<body>
    <div class="box box-info padding-1">
        <div class="box-body">
            @if ($errors->has('user_email'))
                <div class="alert alert-danger">
                    {{ $errors->first('user_email') }}
                </div>
            @endif
            <div class="form-container">
                <div class="form-group">
                    <label for="users_id">{{ __('Usuario') }}</label>
                    <select name="users_id" id="users_id" class="form-control{{ $errors->has('users_id') ? ' is-invalid' : '' }}" placeholder="Usuario">
                        <option value="">Seleccione un usuario</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" data-email="{{ $user->email }}" {{ $user->id == $employee->users_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('users_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    <label for="user_email">{{ __('Correo Electrónico') }}</label>
                    <input type="text" name="user_email" value="{{ $employee->user->email ?? '' }}" class="form-control" id="user_email" readonly>
                </div>
                <div class="form-group">
                    <label for="name">{{ __('Nombres') }}</label>
                    <input type="text" name="name" value="{{ $employee->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombres">
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    <label for="surname">{{ __('Apellidos') }}</label>
                    <input type="text" name="surname" value="{{ $employee->surname }}" class="form-control{{ $errors->has('eps') ? ' is-invalid' : '' }}" placeholder="Apellidos">
                    {!! $errors->first('surname', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    <label for="document_number">{{ __('Número de Documento') }}</label>
                    <input type="text" name="document_number" value="{{ $employee->document_number }}" class="form-control{{ $errors->has('document_number') ? ' is-invalid' : '' }}" placeholder="Número de Documento">
                    {!! $errors->first('document_number', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    <label for="gender">{{ __('Género') }}</label>
                    <select name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                        <option value="" selected>Seleccione género</option>
                        <option value="Hombre" {{ $employee->gender == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Mujer" {{ $employee->gender == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    </select>
                    {!! $errors->first('gender', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    <label for="civil_status">{{ __('Estado Civil') }}</label>
                    <select name="civil_status" class="form-control{{ $errors->has('civil_status') ? ' is-invalid' : '' }}">
                        <option value="" selected>Seleccione estado civil</option>
                        <option value="Casad@" {{ $employee->civil_status == 'Casad@' ? 'selected' : '' }}>Casad@</option>
                        <option value="Solter@" {{ $employee->civil_status == 'Solter@' ? 'selected' : '' }}>Solter@</option>
                    </select>
                    {!! $errors->first('civil_status', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    <label for="eps">{{ __('EPS') }}</label>
                    <input type="text" name="eps" value="{{ $employee->eps }}" class="form-control{{ $errors->has('eps') ? ' is-invalid' : '' }}" placeholder="EPS">
                    {!! $errors->first('eps', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    <label for="phone">{{ __('Teléfono') }}</label>
                    <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Teléfono">
                    {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    <label for="children">{{ __('Hijos') }}</label>
                    <input type="text" name="children" value="{{ $employee->children }}" class="form-control{{ $errors->has('children') ? ' is-invalid' : '' }}" placeholder="Hijos">
                    {!! $errors->first('children', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    <label for="home">{{ __('Lugar de Residencia') }}</label>
                    <input type="text" name="home" value="{{ $employee->home }}" class="form-control{{ $errors->has('home') ? ' is-invalid' : '' }}" placeholder="Lugar de Residencia">
                    {!! $errors->first('home', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    <label for="routes_id">{{ __('Ruta') }}</label>
                    <select name="routes_id" class="form-control{{ $errors->has('routes_id') ? ' is-invalid' : '' }}" placeholder="Ruta">
                    <option value="" selected>Seleccione ruta</option>
                        @foreach($routes as $route_id => $route_name)
                            <option value="{{ $route_id }}" {{ $route_id == $employee->routes_id ? 'selected' : '' }}>
                                {{ $route_name }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('routes_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <br>
        <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
            <a href="{{ route('employee.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('Volver') }}</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userSelect = document.getElementById('users_id');
            const emailInput = document.getElementById('user_email');

            userSelect.addEventListener('change', function() {
                const selectedOption = userSelect.options[userSelect.selectedIndex];
                const email = selectedOption.getAttribute('data-email');
                emailInput.value = email || '';
            });
        });
    </script>
</body>
</html>

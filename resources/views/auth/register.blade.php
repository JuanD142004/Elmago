@extends('layouts.app')

@section('content')
<style>
    .input-border {
        border: 1px solid blue;
        border-radius: 10px;
        background: transparent;
        color: #333;
    }
    
    /* Fondo del formulario transparente */
    .card {
        background-color: rgba(255, 255, 255, 0.7); /* Color de fondo con opacidad */
        border-radius: 10px;
    }
</style>

<div class="container-fluid d-flex justify-content-center align-items-center" style="background-image: url({{ asset('mago.jpg') }}); background-size: cover; background-position: center; min-height: 100vh; background-color: transparent;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient; border-radius: 10px 10px 0 0; color:; font-family: sans-serif;">{{ __('REGISTRAR') }}</div>

                    <div class="card-body">
                        <form id="registroForm" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3" style="color: #333; font-family: sans-serif;">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3" style="color: #333; font-family: sans-serif;">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        @if($message === 'The email has already been taken.')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>El correo electrónico ya está en uso.</strong>
                                            </span>
                                        @else
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @endif
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 " style="color: #333; font-family: sans-serif; align-items: center;">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        <div class="input-group-append" style="margin-right: 10px;">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword1"><i class="far fa-eye"></i></button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span id="passwordError" class="text-danger" style="display: none;">Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</span>
                                </div>
                            </div>

                            <div class="row mb-3 " style="color: #333; font-family: sans-serif; align-items: center;">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <div class="input-group-append" style="margin-right: 10px;">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword2"><i class="far fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <span id="confirmPasswordError" class="text-danger" style="display: none;">Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</span>
                                </div>
                            </div>

                            <div class="row mb-3 " style="color: #333; font-family: sans-serif;">
                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                                <div class="col-md-6">
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                        <option value="user">Usuario</option>
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4 mt-3">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary me-md-2" style="background-color: blue; border: none; font-family: sans-serif;">
                                        {{ __('Registrar') }}
                                    </button>
                                    <button type="button" class="btn btn-primary" style="background-color: blue; border: none; font-family: sans-serif;" onclick="history.back()">Volver</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function capitalizeFirstLetter(str) {
        return str.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()).join(' ');
    }

    document.addEventListener("DOMContentLoaded", function() {
        const togglePassword1 = document.getElementById('togglePassword1');
        const togglePassword2 = document.getElementById('togglePassword2');
        const password1 = document.getElementById('password');
        const password2 = document.getElementById('password-confirm');
        const registroForm = document.getElementById('registroForm');
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');
        const nameInput = document.getElementById('name');

        nameInput.addEventListener('blur', function() {
            nameInput.value = capitalizeFirstLetter(nameInput.value);
        });

        togglePassword1.addEventListener('click', function() {
            const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
            password1.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        togglePassword2.addEventListener('click', function() {
            const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
            password2.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        registroForm.addEventListener('submit', function(event) {
            const password = password1.value;
            const confirmPassword = password2.value;
            const minLength = 8; // Longitud mínima requerida para la contraseña
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            // Verificar longitud mínima de la contraseña
            if (password.length < minLength) {
                passwordError.innerText = 'La contraseña debe tener al menos ' + minLength + ' caracteres.';
                passwordError.style.display = 'block';
                confirmPasswordError.style.display = 'none';
                event.preventDefault(); // Evitar que el formulario se envíe
                return;
            }

            // Verificar si la contraseña cumple con los requisitos de complejidad
            if (!passwordPattern.test(password)) {
                passwordError.innerText = 'La contraseña debe contener al menos una mayúscula, una minúscula, un número, y un carácter especial.';
                passwordError.style.display = 'block';
                confirmPasswordError.style.display = 'none';
                event.preventDefault(); // Evitar que el formulario se envíe
                return;
            }

            passwordError.style.display = 'none';

            // Verificar si las contraseñas coinciden
            if (password !== confirmPassword) {
                confirmPasswordError.innerText = 'Las contraseñas no coinciden. Por favor, inténtalo de nuevo.';
                confirmPasswordError.style.display = 'block';
                event.preventDefault(); // Evitar que el formulario se envíe
                return;
            }

            confirmPasswordError.style.display = 'none';
        });
    });
</script>

@endsection

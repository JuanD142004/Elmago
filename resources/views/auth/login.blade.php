@extends('layouts.app')

@section('content')

    <style>
        
        .input-border {
            border: 1px solid blue;
            border-radius: 10px;
            background: transparent;
            color: #333;
        }
        .no-scrollbar {
            overflow: hidden; /* Oculta ambas barras de desplazamiento */
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none; /* Oculta la scrollbar en Chrome, Safari, etc. */
        }
    </style>

<div class="container-fluid d-flex justify-content-center align-items-center no-scrollbar" style="background-image: url({{ asset('mago.jpg') }}); background-size: cover; background-position: center; min-height: 100vh; background-color: transparent; ">

    <div class="row">
        <div class="col-md-5">
            <div class="d-flex justify-content-center align-items-center">
                <p style="font-family: sans-serif; font-size: 30px; color: white;"><i>Excelencia, Calidad y Compromiso</i></p>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card" style="background: rgba(255, 255, 255, 0.7); border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);">
                <div class="card-header" style="background: linear-gradient; border-radius: 10px 10px 0 0;  font-family: sans-serif;">{{ __('INICIAR SESIÓN') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 position-relative ">
                            <label for="email" class="form-label" style="color: #333;">{{ __('Correo electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="outline: none;">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative ">
                            <label for="password" class="form-label" style="color: #333;">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="outline: none;">
                            <button type="button" class="btn btn-link toggle-password" style="position: absolute; right: 10px; top: 75%; transform: translateY(-50%);"><i class="fas fa-eye"></i></button>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="color: #333; font-family: sans-serif;">
                                {{ __('Recordarme') }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary" style="border-radius: 5px; background-color: blue; border: none; font-family: sans-serif;">
                            {{ __('INICIAR SESIÓN') }}
                        </button>

                        @if(Session::has('registration_success'))
                            <div class="alert alert-success mt-3">
                                {{ Session::get('registration_success') }}
                            </div>
                        @endif

                        @if (Route::has('password.request'))
                            <a class="btn btn-link mt-3" href="{{ route('password.request') }}" style="color: blue; font-family: sans-serif; ">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

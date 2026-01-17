@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="login-card">
        <img src="{{ asset('assets/ceipp-logo.png') }}" alt="CEIPP" class="login-logo">
        <h1 class="login-title">Inicio de Sesi&#243;n</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input
                    id="email"
                    type="email"
                    class="form-control login-input @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Ingrese Correo Electronico"
                    required
                    autocomplete="email"
                    autofocus
                >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input
                        id="password"
                        type="password"
                        class="form-control login-input @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="Ingrese la contrase&#241;a"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="btn btn-outline-secondary login-toggle" id="togglePassword" aria-label="Mostrar contrase&#241;a">
                        &#128065;
                    </button>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="login-link" href="{{ route('password.request') }}">&#191;Has olvidado tu contrase&#241;a?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100 login-button">
                INGRESAR
            </button>
        </form>
    </div>
</div>
@endsection

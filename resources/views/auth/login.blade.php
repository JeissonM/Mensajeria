@extends('layouts.app')

@section('content')
<div class="login-box">
    <form method="POST" class="login-form" action="{{ route('login') }}">
        @csrf
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INGRESAR</h3>
        <div class="form-group">
            <label class="control-label">IDENTIFICACIÓN</label>
            <input class="form-control @error('identificacion') is-invalid @enderror" name="identificacion" value="{{ old('identificacion') }}" required autocomplete="identificacion" autofocus>
            @error('identificacion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <div class="utility">
                <div class="animated-checkbox">
                    <label class="semibold-text">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span class="label-text">Recordarme</span>
                    </label>
                </div>
                @if (Route::has('password.request'))
                <a class="semibold-text mb-0" data-toggle="flip">
                    ¿Olvidó la Contraseña?
                </a>
                @endif
            </div>
        </div>
        <div class="form-group btn-container">
            <button class="btn btn-primary btn-block">INGRESAR  <i class="fa fa-sign-in fa-lg"></i></button>
        </div>
    </form>
    <form class="forget-form" method="POST" action="{{ route('password.email') }}">
        @csrf
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Reestablecer Contraseña</h3>
        <div class="form-group">
            <label class="control-label">CORREO ASOCIADO A LA CUENTA</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group btn-container">
            <button class="btn btn-primary btn-block">ENVIAR ENLACE DE RECUPERACIÓN <i class="fa fa-unlock fa-lg"></i></button>
        </div>
        <div class="form-group mt-20">
            <p class="semibold-text mb-0"><a data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Regresar</a></p>
        </div>
    </form>
</div>
@endsection
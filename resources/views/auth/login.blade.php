@extends('layouts.app')

@section('title', 'Ingreso')

@section('style')
    <style>
    a:hover {
        color: #ff6e40;
    }
    
    </style>
@endsection

@section('content')
<div class="container-fluid h-100 mt-5">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-9 col-md-9 col-lg-7 col-xl-5">
            <div class="card" style="background-color: #f5f0e1;">
                <h1 class="text-center pt-5 mb-5" style="font-weight: bold; color: #ff6e40">Bienvenido a Sortealo</h4>

                <div class="card-body d-flex justify-content-center">
                    <form method="POST" class="col-md-10" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="username" class="col-md-4 h4 text-md-left">Usuario</label>

                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 h4 text-md-left">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="password" class="col-md-4 h4 text-md-left">Empresa</label>

                        <div class="col-md-12">
                            {!! Form::select('company_id', $companies, null, ['placeholder' => 'Seleccione una empresa',"name" => "company_id", "class"=> "form-control form-control-lg", "required", "autofocus"]) !!}

                            @error('company_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="captcha" class="col-md-4 h4 text-md-left">Captcha</label>
                            <div class="col-md-12">
                            {!! htmlFormSnippet() !!}
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="col-md-12 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label h4" for="remember">
                                        Mantener sesion activa
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
                                    Ingresar
                                </button>
                            </div>
                            <div class="col-md-12">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-lg btn-block" id="forgot" href="{{ route('password.request') }}" style="color:#1e3d59;">
                                       Olvidaste tu contraseña
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <hr>
                <span class="text-left h6 ml-3">*Este formulario es exclusivo para empresas, para unirse a nuestro equipo contactenos <a href="{{ route('contact.index') }}?unirse">aqui</a>.</span>
                <span class="text-left h6 ml-3">**En caso de querer participar en uno de los sorteos acceda <a href="/">aqui</a>.</span>
            </div>
        </div>
    </div>
</div>
@endsection
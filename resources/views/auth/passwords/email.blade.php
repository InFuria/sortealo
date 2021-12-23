@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('content')

<div class="container-fluid h-100 mt-5">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-9 col-md-9 col-lg-7 col-xl-5">
            <div class="card" style="background-color: #f5f0e1;">
                <div class="card-header h4">Recuperar Contraseña</div>

                <div class="card-body d-flex justify-content-center">
                    <form method="POST" class="col-11" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-md-4 h4 text-md-left">Email</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

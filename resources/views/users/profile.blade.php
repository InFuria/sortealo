@extends('layouts.app')

@section('title', 'Perfil Usuario')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Start sidebar -->
            @include('layouts.sidebar')
        <!-- End sidebar -->

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">

                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <h1 class="ml-3 p-2 special-title mx-auto">Datos personales del perfil</h1>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center align-items-center col-8 mx-auto">
                    {!! Form::open(['route' => ['users.profile.update', $user->id], 'method' => 'post', 'class' => 'col-md-10', 'files' => true]) !!}
                        <!-- La libreria Laravel Collective que se usa para el form ya genera automaticamente el input '_token' -->
                        <div class="form-group">
                            <label for="name" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Nombre completo</label>

                            <div class="col-md-12">

                                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ isset($user) ? $user->name : old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Usuario o apodo</label>

                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ isset($user) ? $user->username : old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Email</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{  isset($user) ? $user->email : old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Telefono</label>

                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{  isset($user) ? $user->phone : old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 d-inline h4 text-md-left"><p class="text-danger d-inline">* </p>Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="text" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" "{{  isset($user) ? '' : 'required' }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="photo" class="col-md-4 h4 d-inline text-md-left">Foto de perfil</label>

                            @if(isset($user->photo))
                                <a class="h6 font-italic" href="{{  isset($user) ? ( asset('storage/users/'.$user->photo)): '' }}" target="_blank">(Imagen actual)<i></i></a>
                            @endif

                            <div class="col-md-12">
                                <input id="photo" type="file" class="form-control-lg @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" autocomplete="photo" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group row mt-5 mb-5">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
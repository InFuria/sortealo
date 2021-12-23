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
    <label for="role_id" class="col-md-4 d-inline h4 text-md-left"><p class="text-danger d-inline">* </p>Rol</label>

    <div class="col-md-12">
        {!! Form::select('role_id', $roles, null, ['placeholder' => 'Seleccione un rol',"name" => "role_id", "class"=> "form-control form-control-lg", "required", "autofocus"]) !!}

        @error('role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
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

<div class="col-12 pl-0">
    <span class="col-12 text-md-left pl-0 h6 text-danger font-weight-bold"><i>* Campo obligatorio </i></span>

    <br>

    <span class="text-md-left h6 ml-0 pb-5">**En caso de registrar a un administrador no es necesario asignarle una empresa.</span>
</div>


<div class="form-group row mt-5 mb-5">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
            {{ $button }}
        </button>
    </div>
</div>
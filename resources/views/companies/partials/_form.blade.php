<!-- La libreria Laravel Collective que se usa para el form ya genera automaticamente el input '_token' -->
<div class="form-group">
    <label for="name" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Nombre</label>

    <div class="col-md-12">

        <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ isset($company) ? $company->name : old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Email</label>

    <div class="col-md-12">
        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{  isset($company) ? $company->email : old('email') }}" required autocomplete="email" autofocus>

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
        <input id="phone" type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{  isset($company) ? $company->phone : old('phone') }}" required autocomplete="phone" autofocus>

        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="address" class="col-md-4 h4 d-inline text-md-left">Direccion</label>

    <div class="col-md-12">
        <input id="address" type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" name="address" value="{{  isset($company) ? $company->address : old('address') }}" autocomplete="address" autofocus>

        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="form-group">
    <label for="webpage" class="col-md-4 h4 d-inline text-md-left">Pagina web</label>

    <div class="col-md-12">
        <input id="webpage" type="text" class="form-control form-control-lg @error('webpage') is-invalid @enderror" name="webpage" value="{{  isset($company) ? $company->webpage : old('webpage') }}" autocomplete="webpage" autofocus>

        @error('webpage')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="photo" class="col-md-4 h4 d-inline text-md-left">Foto de perfil</label>

    @if(isset($company->photo))
        <a class="h6 font-italic" href="{{  isset($company) ? ( asset('storage/companies/'.$company->photo)): '' }}" target="_blank">(Imagen actual)<i></i></a>
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
</div>


<div class="form-group row mt-5 mb-5">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
            {{ $button }}
        </button>
    </div>
</div>
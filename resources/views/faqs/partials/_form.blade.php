<!-- La libreria Laravel Collective que se usa para el form ya genera automaticamente el input '_token' -->
<div class="form-group mt-5">
    <label for="question" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Pregunta</label>

    <div class="col-md-12">

        <input id="question" type="text" class="form-control form-control-lg @error('question') is-invalid @enderror" name="question" value="{{ isset($faq) ? $faq->question : old('question') }}" required autocomplete="question" autofocus>

        @error('question')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="answer" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Respuesta</label>

    <div class="col-md-12">
        <input id="answer" type="text" class="form-control form-control-lg @error('answer') is-invalid @enderror" name="answer" value="{{ isset($faq) ? $faq->answer : old('answer') }}" required autocomplete="answer" autofocus>

        @error('answer')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="category_id" class="col-md-4 d-inline h4 text-md-left"><p class="text-danger d-inline">* </p>Categoria</label>

    <div class="col-md-12">
        {!! Form::select('category_id', $categories, null, ['placeholder' => 'Seleccione una categoria',"name" => "category_id", "class"=> "form-control form-control-lg", "required", "autofocus"]) !!}

        @error('category_id')
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
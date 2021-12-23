@extends('layouts.app')

@section('title', 'Crear Pregunta')

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
                        <h1 class="ml-3 p-2 special-title mx-auto">Registro de pregunta frecuente</h1>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center col-8 mx-auto">
                    {!! Form::open(['route' => 'faqs.store', 'method' => 'post', 'class' => 'col-md-10', 'files' => true]) !!}
                        @include('faqs.partials._form', ['button' => 'Registrar'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
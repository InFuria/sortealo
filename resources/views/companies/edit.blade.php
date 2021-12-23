@extends('layouts.app')

@section('title', 'Editar Empresa')

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
                        <h1 class="ml-3 p-2 special-title mx-auto">Actualizacion de empresa</h1>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center align-items-center col-8 mx-auto">
                    {!! Form::model($company, ['route' => ['companies.update', $company->id], 'method' => 'post', 'class' => 'col-md-10', 'files' => true]) !!}
                        @method('PUT')
                        @include('companies.partials._form', ['button' => 'Actualizar'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
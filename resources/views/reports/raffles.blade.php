@extends('layouts.app')

@section('title', 'Registro de Sorteos')

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
                    <div class="col-12 mt-4 mb-4">
                        <h1 class="ml-3 p-4 d-inline special-title">Registro de Sorteos</h1>
                    </div>

                        <form class="col-12 ml-3 pl-4 d-flex">
                            <div class="form-row col-12 d-flex justify-content-left">
                                <div class="form-group col-md my-auto">
                                    <label for="start_date">Fecha de Inicio</label>
                                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Fecha de Inicio">
                                </div>

                                <div class="form-group col-md my-auto">
                                    <label for="end_date">Fecha de Fin</label>
                                    <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Fecha de Fin">
                                </div>

                                <div class="form-group col-md my-auto">
                                    <label for="company_id">Empresa</label>
                                    {!! Form::select('company_id', $companies, null, ["name" => "company_id", "class"=> "form-control"]) !!}
                                </div>

                                <div class="form-group col-md my-auto">
                                    <label for="company_id">Categoria</label>
                                    {!! Form::select('category_id', $categories, null, ["name" => "category_id", "class"=> "form-control"]) !!}
                                </div>

                                <div class="form-group col-md my-auto">
                                    <label for="status">Estado</label>
                                    {!! Form::select('status', $statuses, null, ["name" => "status", "class"=> "form-control"]) !!}
                                </div>

                                <div class="form-group col-md my-auto">
                                    <label for="type_winners">Ganadores</label>
                                    {!! Form::select('type_winners', $listTypesWinners, null, ["name" => "type_winners", "class"=> "form-control"]) !!}
                                </div>

                                <div class="form-group col-md my-auto">
                                    <label for="orderBy">Ordenar</label>
                                    {!! Form::select('orderBy', $typesOrder, "created", ["name" => "orderBy", "class"=> "form-control"]) !!}
                                </div>

                                <div class="form-group col-md mb-0 mt-auto">
                                    <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                                </div>
                            </div>                          
                        </form>
                   
                        <div class="col-md-12">
                            <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                                <div class="col-12">
                                    <table class="table table-hover mb-0" id="users-table">
                                        <thead>
                                            <tr>
                                                <th>Usuario</th>
                                                <th class="text-center">Empresa</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Fecha de registro</th>
                                                <th class="action text-right pr-4">Opciones</th>
                                            </tr>
                                        </thead>

                                        <tbody class="user-container">
                                            @foreach($results as $raffle)
                                                <tr>
                                                    <td>{{ $raffle->creator->name }}</td>
                                                    <td class="text-center">{{ $raffle->company->name }}</td>
                                                    <td class="text-center">{{ $raffle->status }}</td>
                                                    <td class="text-center">{{ $raffle->created_at }}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div id="footer">
                                        {{ $results->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>            
                </div>
            </div>
        </div>
        <!-- End Main -->
    </div>
</div>
@endsection
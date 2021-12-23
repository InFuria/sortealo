@extends('layouts.app')

@section('title', 'Detalle de Empresa')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Start sidebar -->
            @include('layouts.sidebar')
        <!-- End sidebar -->

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">
                
                <!-- start -->
              
                <div class="row">
                    <div class="mt-2 d-flex align-items-center">
                        <h1 class="ml-3 p-4 d-inline special-title">Detalle de Empresa</h1>
                        <a class="btn btn-danger btn-md ml-auto" href="{{ route('reports.rafflesByCompany', ['company' => $company->id]) }}">Gestionar sorteos</a>
                    </div>

                    <div class="col-md-12 ">
                        <div class="user-dashboard-info-box d-flex d-inline mb-3 bg-white p-4 shadow-sm">
                            <div class="row col-4 mr-5"> 
                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Nombre:</span>
                                    <span class="ml-auto h5">{{ $company->name }}</span>
                                </div>

                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Email:</span>
                                    <span class="ml-auto h5">{{ $company->email }}</span>
                                </div>

                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Telefono:</span>
                                    <span class="ml-auto h5">{{ $company->phone }}</span>
                                </div>

                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Pagina web:</span>
                                    <span class="ml-auto h5"><a href="{{ $company->webpage }}">{{ $company->webpage }}</a></span>
                                </div>
                            </div>
                            <div class="row col-4 ml-5"> 
                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Cantidad de usuarios:</span>
                                    <span class="ml-auto h5">{{ $company->users_count }}</span>
                                </div>
                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Cantidad de clientes hasta el momento:</span>
                                    <span class="ml-auto h5">150</span>
                                </div>

                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Cantidad de sorteos publicados:</span>
                                    <span class="ml-auto h5">142</span>
                                </div>

                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Cantidad de sorteos finalizados:</span>
                                    <span class="ml-auto h5">140</span>
                                </div>

                                <div class="d-flex col-12">
                                    <span class="mr-auto h5 font-weight-bold">Cantidad de sorteos cancelados:</span>
                                    <span class="ml-auto h5">2</span>
                                </div>                            
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-md-12">
                        <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12">
                                <div class="mt-4">
                                    <h3 class="ml-1 p-4 d-inline special-title">Listado de usuarios asociados</h1>
                                </div>

                                <table class="table table-hover mb-0 mt-4" id="companies-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Telefono</th>
                                            <th class="text-center">Rol</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Registrado desde</th>
                                            <th class="action text-center pr-4">Opciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($users as $user)
                                            <tr class="candidates-list">
                                                <td class="text-center">
                                                    <span>{{ $user->name }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span>{{ $user->username }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span>{{ $user->email }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span>{{ $user->phone }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span>{{ $user->role->name }}</span>
                                                </td>
                                                <td class="text-center">
                                                    @if($user->status == 0)
                                                        <span class="badge badge-danger">Deshabilitado</span>
                                                    @elseif($user->status == 1)
                                                        <span class="badge badge-success">Habilitado</span>
                                                    @endif
                                                </td>
                                                <td class="candidate-list-favourite-time text-center">
                                                    <p>{{ $user->created_at }}</p>
                                                </td>
                                                <td>
                                                <ul class="list-unstyled mb-0 d-flex justify-content-center">
                                                    <li class="p-1"><a href="{{ route('users.index', ['search'=>$user->username]) }}" class="text-info" data-toggle="tooltip" title="Ver usuario"><i class="fas fa-info-circle"></i></a></li>
                                                </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div id="footer">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <!-- end -->

            </div>
            
            <!-- end -->

        </div>
    </div>
</div>
@endsection
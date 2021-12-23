@extends('layouts.app')

@section('title', 'Reportes')

@section('css')
<style>
    .link-report{
        text-decoration: none !important;
    }

    .report-title{
        font-size: 0.99rem !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Start sidebar -->
        @include('layouts.sidebar')
        <!-- End sidebar -->

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card col-12 min-vh-100 my-5">

            <div class="row">
                    <div class="mt-4 mb-4">
                        <h1 class="ml-3 p-4 d-inline special-title">Reportes Generales</h1>
                    </div>
                    
                    @if(Auth::user()->role_id == 2) <!-- Panel para empresas -->
                        <div class="col-md-12">
                            <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                                <div class="col-12 row">

                                    <div class="col-12 d-flex d-inline align-middle">
                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Registros de sorteos</p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Registro de clientes</p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Registro de empresas</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-12 d-flex d-inline align-middle">
                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Actividad de usuarios</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-12 d-flex d-inline align-middle">
                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Tickets Vendidos</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else <!-- Panel para admins y staff -->
                        <div class="col-md-12">
                            <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                                <div class="col-12 row">

                                    <div class="col-12 d-flex d-inline align-middle">
                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Registros de sorteos</p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Registro de clientes</p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Registro de empresas</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-12 d-flex d-inline align-middle">
                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Registro de ganadores</p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Actividad de clientes</p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Actividad de usuarios</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-12 d-flex d-inline align-middle">
                                        <a href="{{ route('reports.raffles') }}" class="link-report my-2 my-2 col-3">
                                            <div class="card col-9 rounded">
                                                <div class="card-header bg-white">
                                                    <p class="report-title mb-0">Tickets Vendidos</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- End Main -->
    </div>
</div>
@endsection

@section('js')
<script>

</script>
@endsection
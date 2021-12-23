@extends('layouts.app')

@section('title', 'Soporte')

@section('css')
<style>
    .link-report{
        text-decoration: none !important;
    }

    .report-title{
        font-size: 1.1rem !important;
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
                        <h1 class="ml-3 p-4 d-inline special-title">Soporte</h1>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12 d-flex d-inline justify-content-around">
                                <div class="card bg-white col mx-2">
                                    <div class="card-header bg-white">
                                        <p class="report-title"><i class="fas fa-money-check-alt"></i> Pagos</p>

                                        <ul class="list-group">
                                            <li class="list-group-item"><a href="">Buscar pago por id de transaccion</a></li>
                                            <li class="list-group-item"><a href="">Modificar estado de un pago</a></li>
                                            <li class="list-group-item"><a href="">Listar pagos generales</a></li>
                                            <li class="list-group-item"><a href="">Historial de pago por cliente</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card bg-white col mx-2">
                                    <div class="card-header bg-white">
                                        <p class="report-title"><i class="fas fa-mail-bulk"></i> Avisos y Emails</p>

                                        <ul class="list-group">
                                            <li class="list-group-item"><a href="">Solicitudes de registro como empresa</a></li>
                                            <li class="list-group-item"><a href="">Enviar email a todos los registrados</a></li>
                                            <li class="list-group-item"><a href="">Notificar a los registrados en un sorteo especifico</a></li>
                                            <li class="list-group-item"><a href="">Notificar a los usuarios empresa</a></li>
                                        </ul>
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

@section('js')
<script>

</script>
@endsection
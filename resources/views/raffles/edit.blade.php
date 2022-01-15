@extends('layouts.app')

@section('title', 'Editar Sorteo')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .datepicker,
        .table-condensed {
            width: 21rem;

        }

        .table-condensed thead tr th.next:hover,
        .table-condensed thead tr th.prev:hover,
        .table-condensed tbody tr td.day:hover,
        .table-condensed tbody tr td.hour:hover,
        .table-condensed tbody tr td.minute:hover,
        .table-condensed tbody tr td.second:hover,
        .table-condensed tfoot tr th:hover
        {
            color: white;
            background-color: rgb(255,110,64, .7);
        }

        .xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box >div >div.xdsoft_current,
        .xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current {
            background: rgb(30, 61, 89, 0.7) !important;
            box-shadow: rgb(30, 61, 89, 0.7) 0 1px 3px 0 inset;
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
            <div class="card bg-light col-12 min-vh-100 my-5">

                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <h1 class="ml-3 p-2 special-title mx-auto">Actualizacion de sorteo</h1>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center align-items-center col-11 mx-auto">
                    {!! Form::model($raffle, ['route' => ['raffles.update', $raffle->id], 'method' => 'post', 'class' => 'col-md-10', 'files' => true]) !!}
                        @method('PUT')
                        @include('raffles.partials._form', ['button' => 'Actualizar'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('raffles.partials._delete')

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" integrity="sha512-5pjEAV8mgR98bRTcqwZ3An0MYSOleV04mwwYj2yw+7PBhFVf/0KcE+NEox0XrFiU5+x5t5qidmo5MgBkDD9hEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){

        var date_time_picker = $('input.raffle-date').datetimepicker({
            format: 'd/m/Y H:i:s',
            closeOnDateSelect: true,
            closeOnWithoutClick: true
        });
        $.datetimepicker.setLocale('es');

        $(date_time_picker[0]).val({!! json_encode(date("d/m/Y H:i:s",strtotime($raffle->start_date))) !!}); // Inicio de sorteo
        $(date_time_picker[1]).val({!! json_encode(date("d/m/Y H:i:s",strtotime($raffle->end_date))) !!}); // Cierre de sorteo
        $(date_time_picker[2]).val({!! json_encode($raffle->raffle_date) == '"0000-00-00 00:00:00"' ? str_replace('-', '/', json_encode($raffle->raffle_date)) : json_encode(date("d/m/Y H:i:s",strtotime($raffle->raffle_date))) !!}); // Cierre de sorteo

        /* Manejo de imagenes */
        $(document).on('click', '.btn-delete-image', function(e) {

            jQuery.noConflict();

            let button = $(this);
            let modal = $('#deleteImage');

            let id = button.data('id');

            let message = "Esta seguro que desea eliminar esta imagen? Esta acion no se podra deshacer...";

            let route = '{{ route("raffles.removeImage", ":file") }}';
            route = route.replace(':file', id);

            modal.find('form').attr('action', route);

            modal.find('#title-delete').text(message);

            modal.modal('show');
            
        });
    });

    /* Manejo de input de multiples ganadores */
    $('.form-check-input').on('change', function(){
        let type = $(this).data('type');
        let input = $('#extra_winners');

        input.val(0);

        if(type == 1){
            input.prop( "disabled", false );
        } else {
            input.prop( "disabled", true );
        }
    });
</script>
@append
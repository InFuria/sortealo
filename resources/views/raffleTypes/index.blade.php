@extends('layouts.app')

@section('title', 'Tipos de sorteos')

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
                    <div class="mt-4">
                        <h1 class="ml-3 p-4 d-inline special-title">Gestion de tipos de sorteos</h1>
                        <a class="d-inline btn-create" href="#" title="Crear categoria">
                            <i class="far fa-plus-square fa-2x"></i>
                        </a>
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12">
                                @if(!$types->isEmpty())
                                    <table class="table table-hover mb-0" id="companies-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Veces usado</th>
                                                <th class="text-center">Creado</th>
                                                <th class="text-center">Ultima modificacion</th>
                                            </tr>
                                        </thead>

                                    
                                        <div class="input-group rounded">
                                            <input type="search" class="form-control border-right-0" id="search-type" placeholder="Ingresa el nombre de la categoria" aria-label="Search" aria-describedby="search-addon" />
                                            <span class="input-group-text rounded-right border-left-0" id="search-addon" style="border-top-left-radius:0; border-bottom-left-radius:0;">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>

                                        <tbody>
                                            @foreach($types as $type)
                                                <tr class="candidates-list">
                                                    <td class="candidate-list-favourite-time text-center">
                                                        <p>{{ $type->name }}</p>
                                                    </td>
                                                    <td class="candidate-list-favourite-time text-center">
                                                        <p>{{ $type->raffles_count }}</p>
                                                    </td>
                                                    <td class="candidate-list-favourite-time text-center">
                                                        <p>{{ $type->created_at }}</p>
                                                    </td>
                                                    <td class="candidate-list-favourite-time text-center">
                                                        <p>{{ $type->updated_at }}</p>
                                                    </td>
                                                    <td>
                                                    <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                        <li class="p-1"><a href="#" class="text-success btn-edit" data-toggle="tooltip" title="Editar categoria" data-id="{{ $type->id }}"><i class="fas fa-pencil-alt"></i></a></li>
                                                        <li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar categoria" data-id="{{ $type->id }}" data-name="{{ $type->name }}"><i class="far fa-trash-alt"></i></a></li>
                                                    </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h5 class="text-center w-100">No se encontraron registros</h5>
                                @endif

                                <div id="footer">
                                    {{ $types->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <!-- end -->
            
            </div>
        </div>
        <!-- End Main -->
    </div>
</div>
@endsection

@include('raffleTypes.partials._delete')
@include('raffleTypes.partials._update')
@include('raffleTypes.partials._create')


@section('js')
<script>
$(document).ready(function() {
    $('#search-type').on('keyup', function() {
        $.ajax({
            type: 'get',
            data: {'search': $(this).val()},
            url: '{{ route("raffleTypes.index") }}',
            success:function(data) {

                $('#companies-table > tbody').empty();

                $.each(data.data, function( index, value ) {

                    let tr = $('<tr class="candidates-list"><td class="candidate-list-favourite-time text-center">' +
                    '<p>' + value.name + '</p></td><td class="candidate-list-favourite-time text-center">'+
                    '<p>' + value.raffles_count + '</p></td><td class="candidate-list-favourite-time text-center">'+
                    '<p>' + value.created_at + '</p></td><td class="candidate-list-favourite-time text-center">'+
                    '<p>' + value.updated_at + '</p></td><td>'+
                    '<ul class="list-unstyled mb-0 d-flex justify-content-end">'+
                    '<li class="p-1"><a href="#" class="text-success btn-edit" data-toggle="tooltip" title="Editar categoria" data-id="' + value.id + '"><i class="fas fa-pencil-alt"></i></a></li>'+
                    '<li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar categoria" data-id="'+ value.id +'" data-name="'+ value.name +'"><i class="far fa-trash-alt"></i></a></li>'+
                    '</ul></td></tr>');
                    
                    $('#companies-table > tbody').append(tr);
                });
            }
        });
    });
});


/* Manejo de modal de creacion */
$(document).on('click', '.btn-create', function(e) {

let button = $(this);
let modal = $('#createTypes');

modal.modal('show');
    
});

/* Manejo de modal de actualizacion */
$(document).on('click', '.btn-edit', function(e) {

    let button = $(this);
    let modal = $('#updateTypes');

    let id = button.data('id');

    $.ajax({
        type: 'get',
        data: {'id': id},
        url: '{{ route("raffleTypes.getType") }}',
        success:function(value) {

            let route = '{{ route("raffleTypes.update", ":id") }}';
            route = route.replace(':id', id);

            modal.find('form').attr('action', route);
            modal.find('form #name').val(value.name);

            modal.modal('show');
        }
    });
});

/* Manejo de modal de eliminacion */
$(document).on('click', '.btn-delete', function(e) {

    let button = $(this);
    let modal = $('#deleteTypes');

    let id = button.data('id');
    let name = button.data('name');

    let message = "Esta seguro que desea eliminar la categoria `" + name + "`? Esta acion no se podra deshacer...";

    let route = '{{ route("raffleTypes.destroy", ":id") }}';
    route = route.replace(':id', id);

    modal.find('form').attr('action', route);

    modal.find('#title-delete').text(message);

    modal.modal('show');
});

</script>

@append
@extends('layouts.app')

@section('title', 'Compañias')

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
                        <h1 class="ml-3 p-4 d-inline special-title">Empresa</h1>
                        <a class="d-inline" href="{{ route('companies.create') }}" title="Crear empresa">
                            <i class="far fa-plus-square fa-2x"></i>
                        </a>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12">
                                <table class="table table-hover mb-0" id="companies-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Empresa</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Pagina Web</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Fecha de registro</th>
                                            <th class="action text-right pr-4">Opciones</th>
                                        </tr>
                                    </thead>

                                    <div class="input-group rounded">
                                        <input type="search" class="form-control border-right-0" id="search-company" placeholder="Ingresa el nombre de la empresa o su email" aria-label="Search" aria-describedby="search-addon" />
                                        <span class="input-group-text rounded-right border-left-0" id="search-addon" style="border-top-left-radius:0; border-bottom-left-radius:0;">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>

                                    <tbody>
                                        @foreach($companies as $company)
                                            <tr class="candidates-list">
                                                <td class="title">
                                                <div class="thumb">
                                                    @if(isset($company->photo))
                                                        <img class="img-user ml-3" src="{{ asset('storage/companies/' . $company->photo) }}" alt="">
                                                    @else
                                                        <img class="img-user ml-3" src="{{ asset('storage/companies/default.png')}}" alt="">
                                                    @endif
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                    <div class="candidate-list-title">
                                                        <h5 class="mb-0"><a href="{{ route('companies.edit', ['company' => $company->id]) }}">{{ $company->name }}</a></h5>
                                                    </div>
                                                    <div class="candidate-list-option">
                                                        <ul class="list-unstyled">
                                                        <li><i class="fas fa-home pr-1"></i>{{ $company->address !== "" ? $company->address : "No registra direccion" }}</li>
                                                        <li><i class="fas fa-phone pr-1"></i>{{ $company->phone !== "" ? $company->phone : 'No registra telefono' }}</li>
                                                        </ul>
                                                    </div>
                                                    </div>
                                                </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="badge badge-info text-white">{{ $company->email }}</a>
                                                </td>
                                                <td class="candidate-list-favourite-time text-center">
                                                    @if(isset($company->webpage))
                                                        <p>{{ $company->webpage }}</p>
                                                    @elseif($company->status == 1)
                                                        <p>No registra</p>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($company->status == 0)
                                                        <span class="badge badge-danger">Deshabilitado</span>
                                                    @elseif($company->status == 1)
                                                        <span class="badge badge-success">Habilitado</span>
                                                    @endif
                                                </td>
                                                <td class="candidate-list-favourite-time text-center">
                                                    <p>{{ $company->created_at }}</p>
                                                </td>
                                                <td>
                                                <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                    @if($company->status == 0)
                                                        <li class="p-1"><a href="{{ route('companies.status', ['company' => $company->id]) }}" class="text-success btn-status" title="Habilitar empresa"><i class="far fa-eye"></i></a></li>
                                                    @else
                                                        <li class="p-1"><a href="{{ route('companies.status', ['company' => $company->id]) }}" class="text-danger btn-status" title="Deshabilitar empresa"><i class="fas fa-eye-slash"></i></a></li>
                                                    @endif
                                                    <li class="p-1"><a href="{{ route('companies.show', ['company'=> $company->id]) }}" class="text-info" data-toggle="tooltip" title="Detalle empresa" data-original-title="Detalle"><i class="fas fa-info-circle"></i></a></li>
                                                    <li class="p-1"><a href="{{ route('companies.edit', ['company'=> $company->id]) }}" class="text-success" data-toggle="tooltip" title="Editar empresa" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                                    <li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar empresa" data-id="{{ $company->id }}" data-name="{{ $company->name }}"><i class="far fa-trash-alt"></i></a></li>
                                                </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div id="footer">
                                    {{ $companies->links() }}
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

@include('companies.partials._delete')

@section('js')
<script>
$(document).ready(function() {
        $('#search-company').on('keyup', function() {
            $.ajax({
                type: 'get',
                data: {'search': $(this).val()},
                url: '{{ route("companies.index") }}',
                success:function(data) {

                    $('#companies-table > tbody').empty();

                    $.each(data.data, function( index, value ) {

                        let edit = "{!! route('companies.edit', ':id') !!}";
                        edit = edit.replace(':id', value.id);

                        let show = "{!! route('companies.show', ':id') !!}";
                        show = show.replace(':id', value.id);

                        let statusRoute = "{!! route('companies.status', ':id') !!}"
                        statusRoute = statusRoute.replace(':id', value.id);

                        let photo = value.photo !== "" && value.photo !== null ? "<img class='img-user ml-3' src='{{ asset('storage/companies/')}}/" + value.photo + "' alt=''>" : "<img class='img-user ml-3' src='{{ asset('storage/companies/default.png')}}' alt=''>";
                        let address = value.address !== "" && value.address !== null ? value.address : "No registra direccion";
                        let phone = value.phone !== "" && value.phone !== null ? value.phone : "No registra telefono";
                        let webpage = value.webpage !== "" && value.webpage !== null ? "<p>" + value.webpage + "</p>" : "<p>No registra</p>";
                        let status = value.status == 0 ? '<span class="badge badge-danger">Deshabilitado</span>' : '<span class="badge badge-success">Habilitado</span>';
                        let changeStatus = value.status == 0 ? '<li class="p-1"><a href="'+statusRoute+'" class="text-success btn-status" title="Habilitar empresa"><i class="far fa-eye"></i></a></li>' : '<li class="p-1"><a href="'+statusRoute+'" class="text-danger btn-status" title="Deshabilitar empresa"><i class="fas fa-eye-slash"></i></a></li>';
          
                        let tr = $('<tr class="candidates-list"><td class="title"><div class="thumb">' + photo + '</div>'+
                                '<div class="candidate-list-details"><div class="candidate-list-info"><div class="candidate-list-title">'+
                                '<h5 class="mb-0"><a href="' + edit + '">' + value.name + '</a></h5></div>'+
                                '<div class="candidate-list-option"><ul class="list-unstyled">'+
                                '<li><i class="fas fa-home pr-1"></i>' + address +'</li><li><i class="fas fa-phone pr-1"></i>' + phone + '</li></ul></div></div>'+
                                '</div></td><td class="text-center"><a href="#" class="badge badge-info text-white">' + value.email + '</a></td>'+
                                '<td class="candidate-list-favourite-time text-center">'+ webpage+ '</td>'+
                                '<td class="text-center">' + status + '</td>'+
                                '<td class="candidate-list-favourite-time text-center"><p>' + value.created_at + '</p></td><td>' +
                                '<ul class="list-unstyled mb-0 d-flex justify-content-end">' +
                                changeStatus+
                                '<li class="p-1"><a href="'+ show +'" class="text-info" data-toggle="tooltip" title="Detalle empresa" data-original-title="Detalle"><i class="fas fa-info-circle"></i></a></li>'+
                                '<li class="p-1"><a href="' + edit + '" class="text-success" data-toggle="tooltip" title="Editar" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>'+
                                '<li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar empresa" data-id="' + value.id + '" data-name="' + value.name + '"><i class="far fa-trash-alt"></i></a></li>'+
                                '</ul></td></tr>');

                        $('#companies-table > tbody').append(tr);                       
                    });
                }
            });
        });
});


$(document).on('click', '.btn-delete', function(e) {

    let button = $(this);
    let modal = $('#deleteCompanies');

    let id = button.data('id');
    let name = button.data('name');

    let message = "Esta seguro que desea eliminar la empresa `" + name + "`? Esta acion no se podra deshacer...";

    let route = '{{ route("companies.destroy", ":id") }}';
    route = route.replace(':id', id);

    modal.find('form').attr('action', route);

    modal.find('#title-delete').text(message);

    modal.modal('show');
});

</script>

@append
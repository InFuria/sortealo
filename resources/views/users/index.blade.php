@extends('layouts.app')

@section('title', 'Usuarios')

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
                    <div class="mt-4 mb-4">
                        <h1 class="ml-3 p-4 d-inline special-title">Usuarios</h1>
                        <a class="d-inline" href="{{ route('users.create') }}" title="Crear usuario">
                            <i class="far fa-plus-square fa-2x"></i>
                        </a>
                    </div>
                    
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

                                    <div class="input-group rounded">
                                        <input type="search" class="form-control border-right-0" id="search-user" placeholder="Ingresa un nombre de usuario o email" aria-label="Search" aria-describedby="search-addon" />
                                        <span class="input-group-text rounded-right border-left-0" id="search-addon" style="border-top-left-radius:0; border-bottom-left-radius:0;">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>

                                    <tbody class="user-container">
                                        @foreach($users as $user)
                                            <tr class="candidates-list">
                                                <td class="title">
                                                <div class="thumb">
                                                    @if(isset($user->photo))
                                                        <img class="img-user ml-3" src="{{ asset('storage/users/' . $user->photo)}}" alt="">
                                                    @else
                                                        <img class="img-user ml-3" src="{{ asset('storage/users/default.png')}}" alt="">
                                                    @endif
                                                </div>
                                                <div class="candidate-list-details">
                                                    <div class="candidate-list-info">
                                                    <div class="candidate-list-title">
                                                        <h5 class="mb-0"><a href="{{ route('users.edit', ['user' => $user->id]) }}">{{ $user->name }} <i>({{ $user->username }})</i></a></h5>
                                                    </div>
                                                    <div class="candidate-list-option">
                                                        <ul class="list-unstyled">
                                                        <li><i class="fas fa-filter pr-1"></i>{{ $user->email }}</li>
                                                        <li><i class="fas fa-user-tag pr-1"></i>{{ $user->role->name }}</li>
                                                        </ul>
                                                    </div>
                                                    </div>
                                                </div>
                                                </td>
                                                <td class="text-center">
                                                    @if(isset($user->company))
                                                        <a href="#" class="badge badge-info text-white">{{ $user->company->name }}</a>
                                                    @else
                                                        <a href="#" class="badge badge-secondary">No asociado</a>
                                                    @endif
                                                </td>
                                                <td class="candidate-list-favourite-time text-center">
                                                    @if($user->status == 0)
                                                        <span class="badge badge-danger">Deshabilitado</span>
                                                    @elseif($user->status == 1)
                                                        <span class="badge badge-success">Habilitado</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $user->created_at }}
                                                </td>
                                                <td>
                                                <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                    @if($user->status == 0)
                                                        <li class="p-1"><a href="{{ route('users.status', ['user' => $user->id]) }}" class="text-success btn-status" title="Habilitar usuario"><i class="far fa-eye"></i></a></li>
                                                    @else
                                                        <li class="p-1"><a href="{{ route('users.status', ['user' => $user->id]) }}" class="text-danger btn-status" title="Deshabilitar usuario"><i class="fas fa-eye-slash"></i></a></li>
                                                    @endif
                                                    <li class="p-1"><a href="{{ route('users.edit', ['user'=> $user->id]) }}" class="text-info" data-toggle="tooltip" title="Editar usuario" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                                    <li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar usuario" data-id="{{ $user->id }}" data-username="{{ $user->username }}"><i class="far fa-trash-alt"></i></a></li>
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
        </div>
        <!-- End Main -->
    </div>
</div>
@endsection

@include('users.partials._delete')

@section('js')
<script>
$(document).ready(function() {
    $('#search-user').on('keyup', function() {
        $.ajax({
            type: 'get',
            data: {'search': $(this).val()},
            url: '{{ route("users.index") }}',
            success:function(data) {
                $('#users-table > tbody').empty();

                $.each(data.data, function( index, value ) {

                    let company = value.company !== null ? '<a href="#" class="badge badge-info text-white">' + value.company.name + '</a>' : '<a href="#" class="badge badge-secondary">No asociado</a>';
                    let status = value.status == 0 ? '<span class="badge badge-danger">Deshabilitado</span>' : '<span class="badge badge-success">Habilitado</span>';
                    let photo = value.photo !== "" && value.photo !== null ? "<img class='img-user ml-3' src='{{ asset('storage/users/')}}/" + value.photo + "' alt=''>" : "<img class='img-user ml-3' src='{{ asset('storage/users/default.png')}}' alt=''>";

                    let statusRoute = "{!! route('users.status', ':id') !!}"
                    statusRoute = statusRoute.replace(':id', value.id);

                    let editRoute = "{!! route('users.edit', ':id') !!}"
                    editRoute = editRoute.replace(':id', value.id);

                    let changeStatus = value.status == 0 ? '<li class="p-1"><a href="'+statusRoute+'" class="text-success btn-status" title="Habilitar usuario"><i class="far fa-eye"></i></a></li>' : '<li class="p-1"><a href="'+statusRoute+'" class="text-danger btn-status" title="Deshabilitar usuario"><i class="fas fa-eye-slash"></i></a></li>';

                    let tr = $('<tr class="candidates-list"><td class="title"><div class="thumb">'+ photo +
                            '</div><div class="candidate-list-details"><div class="candidate-list-info">'+
                            '<div class="candidate-list-title"><h5 class="mb-0"><a href="#">'+ value.name +'<i>(' + value.username + ')</i></a></h5>'+
                            '</div><div class="candidate-list-option"><ul class="list-unstyled"><li><i class="fas fa-filter pr-1"></i>' + value.email + '</li>'+
                            '<li><i class="fas fa-user-tag pr-1"></i>' + value.role.email + '</li></ul></div></div></div></td>'+
                            '<td class="text-center">'+
                                company +
                            '</td>'+
                            '<td class="candidate-list-favourite-time text-center">'+
                                status +
                            '</td>'+
                            '<td class="text-center">'+ value.created_at + '</td>'+
                            '<td>' +
                            '<ul class="list-unstyled mb-0 d-flex justify-content-end">' +
                                changeStatus +
                                
                                '<li class="p-1"><a href="'+ editRoute +'" class="text-info" data-toggle="tooltip" title="Editar usuario" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>'+
                                '<li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar usuario" data-id="'+ value.id +'" data-username="'+ value.username +'"><i class="far fa-trash-alt"></i></a></li>'+
                            '</ul></td></tr>'
                    );



                    $('#users-table > tbody').append(tr);                       
                });
            }
        });
    });
});



$(document).on('click', '.btn-delete', function(e) {
    let button = $(this);
    let modal = $('#deleteUsers');

    let id = button.data('id');
    let username = button.data('username');

    let message = "Esta seguro que desea eliminar al usuario `" + username + "`?";

    let route = '{{ route("users.destroy", ":id") }}';
    route = route.replace(':id', id);

    modal.find('form').attr('action', route);

    modal.find('#title-delete').text(message);

    modal.modal('show');
});

</script>

@append
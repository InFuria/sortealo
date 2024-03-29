@extends('layouts.app')

@section('title', 'Sorteos')

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
                    <div class="mt-4 col-12 d-flex align-items-center">
                        <div class="d-flex col-6 d-flex d-inline align-items-center">
                            <h1 class="p-2 special-title">Sorteos</h1>
                            <a href="{{ route('raffles.create') }}" title="Crear sorteo">
                                <i class="far fa-plus-square fa-2x"></i>
                            </a>
                        </div>

                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                        <div class="col-6 d-flex">
                            <a class="btn btn-danger btn-md ml-auto" href="{{ route('raffleCategories.index') }}">Gestionar categorias</a>
                            <!-- <a class="btn btn-danger btn-md mx-2" href="{{ route('raffleTypes.index') }}">Gestionar tipos de sorteo</a> -->
                        </div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12">
                                <table class="table table-hover mb-0" id="raffles-table">
                                    <thead>
                                        <tr>
                                            <th>Titulo</th>
                                            <th>Descripcion</th>
                                            <th class="text-center">Categoria</th>
                                            <th class="text-center">Cantidad de tickets</th>
                                            <th class="text-center">Duracion</th>
                                            <th class="text-center">Estado</th>

                                            @if(Auth::user()->role_id == 1)
                                            <th class="text-center">Empresa</th>
                                            @endif

                                            <th class="text-center">Ultima modificacion</th>
                                            <th class="action text-right pr-4">Opciones</th>
                                        </tr>
                                    </thead>

                                    <div class="input-group rounded">
                                        <input type="search" class="form-control border-right-0" id="search-raffle" placeholder="Busca por titulo, descripcion o categoria" aria-label="Search" aria-describedby="search-addon" />
                                        <span class="input-group-text rounded-right border-left-0" id="search-addon" style="border-top-left-radius:0; border-bottom-left-radius:0;">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>

                                    <tbody class="user-container">
                                        @foreach($raffles as $raffle)
                                            <tr class="candidates-list">
                                                <td class="text-center">
                                                    {{ $raffle->title }}
                                                </td>

                                                <td class="text-center ">
                                                    {{ substr($raffle->description, 0, 170) . '...' }}
                                                </td>

                                                <td class="text-center">
                                                    {{ $raffle->category->name }}
                                                </td>

                                                <td class="text-center">
                                                    {{ $raffle->quantity_tickets }}
                                                </td>

                                                <td class="text-center col-2">
                                                
                                                    {{ Carbon\Carbon::parse($raffle->start_date)->translatedFormat('d F Y') }} 
                                                    <br/>al<br/>
                                                    {{ Carbon\Carbon::parse($raffle->end_date)->translatedFormat('d F Y') }}
                                                </td>

                                                

                                                <td class="candidate-list-favourite-time text-center">
                                                    @if($raffle->status == 2)
                                                        <span class="badge badge-warning">Pendiente</span>
                                                    @elseif($raffle->status == 1)
                                                        <span class="badge badge-success">En Curso</span>
                                                    @elseif($raffle->status == 3)
                                                        <span class="badge badge-info text-white">Terminado</span>
                                                    @elseif($raffle->status == 4)
                                                        <span class="badge badge-danger">Cancelado</span>
                                                    @endif
                                                </td>

                                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                                                <td class="text-center">
                                                    <a href="{{ route('companies.index') }}?search={{$raffle->company->name}}">{{ $raffle->company->name }}<a>
                                                </td>
                                                @endif

                                                <td class="text-center">
                                                    {{ $raffle->updated_at }}
                                                </td>

                                                <td class="text-center">
                                                    <ul class="list-unstyled mb-0 d-flex justify-content-center">
                                                        <li class="p-1"><a href="{{ route('reports.raffleDetail', ['raffle' => $raffle->id]) }}" class="text-success btn-status" title="Ver vendidos"><i class="far fa-eye"></i></a></li>
                                                        <li class="p-1"><a href="{{ route('raffles.edit', ['raffle'=> $raffle->id]) }}" class="text-info" data-toggle="tooltip" title="Editar sorteo" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div id="footer">
                                    {{ $raffles->links() }}
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

@section('js')
<script>
$(document).ready(function() {
    $('#search-raffle').on('keyup', function() {
        $.ajax({
            type: 'get',
            data: {'search': $(this).val()},
            url: '{{ route("raffles.index") }}',
            success:function(data) {
                $('#raffles-table > tbody').empty();

                $.each(data.data, function( index, value ) {

                    let status;
                    if(value.status == 2){
                        status = '<span class="badge badge-warning">Pendiente</span>'
                    }
                    if(value.status == 1){
                        status = '<span class="badge badge-success">En Curso</span>'
                    }
                    if(value.status == 3){
                        status = '<span class="badge badge-info text-white">Terminado</span>'
                    }
                    if(value.status == 4){
                        status = '<span class="badge badge-danger">Cancelado</span>'
                    }
                

                    const options = { day: 'numeric', month: 'long', year: 'numeric'  };

                    let start_date = new Date(value.start_date).toLocaleDateString('es-ES', options);
                    let end_date = new Date(value.end_date).toLocaleDateString('es-ES', options);

                    let tr = $('<tr class="candidates-list"><td class="text-center">'+ value.title + '</td>' +
                    '<td class="text-center ">'+ value.description.substr(0, 169) + '...</td>'+
                    '<td class="text-center">'+ value.category.name +'</td>'+
                    '<td class="text-center">'+ value.quantity_tickets + '</td>'+

                    '<td class="text-center col-2">'+ start_date +'<br/>al<br/>'+ end_date +'</td>'+
                    '<td class="candidate-list-favourite-time text-center">'+
                        status +
                    '</td>'+
                    '<td class="text-center"><a href="{{ route("companies.index") }}?search='+ value.company.name +'">'+ value.company.name +'<a></td>'+
                    '<td class="text-center">'+ value.updated_at +'</td>'+
                    '<td class="text-center">'+
                        '<ul class="list-unstyled mb-0 d-flex justify-content-center">'+
                           '<li class="p-1"><a href="{{ route("reports.raffleDetail", ["raffle" => '+ value.id +']) }}" class="text-success btn-status" title="Ver vendidos"><i class="far fa-eye"></i></a></li>'+
                            '<li class="p-1"><a href="{{ route("raffles.edit", ["raffle"=> '+ value.id +']) }}" class="text-info" data-toggle="tooltip" title="Editar sorteo" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>'+
                        '</ul></td></tr>');


                    $('#raffles-table > tbody').append(tr);                       
                });
            }
        });
    });
});
</script>
@endsection
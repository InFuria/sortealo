@extends('layouts.app')

@section('title', 'Resultados')

@section('css')
<style>
    .col-custom{
        max-width: 380px;
    }

    a.raffle-item {
        color: #212529;
        cursor:pointer;
        text-decoration: none;
    }

    a.raffle-item:hover {
        color: #6c757d;
        text-decoration: none;
        cursor: pointer;
    }

    .active-filter{
        background-color: #ff6e40;
        color: white !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">

                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <h1 class="ml-3 p-2 special-title mx-auto">Resultados de sorteos</h1>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center mt-5 col-11 mx-auto">
                    <div class="container-fluid d-flex flex-column pb-5">
            
                        @if($raffles->isEmpty())
                        <div class="row mt-3 d-flex justify-content-center">
                            <div class="card w-75 text-center" style="height: 400px;">
                                <div class="card-body d-flex flex-column justify-content-center align-middle">
                                    <h4 class="card-title">No se han encontrado resultados para esta busqueda</h5>
                                    <a href="/" class="btn btn-danger w-25 mx-auto">Volver al inicio</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @foreach($raffles->chunk(4) as $partialRaffles)
                            <div class="row mt-3 d-flex">
                                @foreach($partialRaffles as $raffle)
                                    <div class="card col col-custom mx-3 p-0">
                                        <div id="carousel-{{ $raffle->id }}" class="carousel border-bottom border-dark slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @if(count($raffle->files) > 0)
                                                    @foreach($raffle->files as $file)
                                                        <div class="carousel-item {{ $raffle->files[0]->id == $file->id ? 'active' : '' }}">
                                                            <img src="{{ asset('storage/raffles/' . $file->name) }}" class="d-block w-auto mx-auto" alt="{{ $raffle->title }}">
                                                        </div>
                                                    @endforeach
                                                @else
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('storage/raffles/no-disponible.png') }}" class="d-block w-auto mx-auto" alt="{{ $raffle->title }}">
                                                </div>
                                                @endif
                                                
                                            </div>

                                            <!-- Controles -->
                                            <a class="carousel-control carousel-control-prev my-auto" href="#carousel-{{ $raffle->id }}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control carousel-control-next my-auto" href="#carousel-{{ $raffle->id }}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>

                                        <a class="raffle-item" href="{{ route('raffles.detail', ['raffle'=> $raffle->id]) }}">
                                            <div class="card-body pt-1 pl-2 pr-1 pb-0">
                                                <p class="text-danger font-weight-bold mb-1"><i class="fas fa-exclamation-triangle fa-sm"></i> Finalizo el {{ $raffle->end_date }}</p>
                                                <h4 class="card-text font-weight-bold">{{ strlen($raffle->title) > 30 ? substr($raffle->title, 0, 30) . '...' : $raffle->title}}</p>
                                                <p class="h5">{{ strlen($raffle->description) > 100 ? substr($raffle->description, 0, 100) . '...' : $raffle->description}}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <footer class="mt-auto">
                        {{ $raffles->links() }}
                        </footer>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
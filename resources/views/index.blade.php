@extends('layouts.app')

@section('title', 'Inicio')

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
<div class="container justify-content-center col-11">

    <div class="card col-10 m-auto border-0 rounded shadow-lg mb-5" style="opacity: 1; height: 300px;">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center d-flex mt-5 flex-column">
                    <p class="h4 p-2">Los mejores sorteos!</p>
                    <p class="text h4 p-2">Bienvenido a Sortealo! Disfruta de todas nuestras ofertas de sorteos! Cada dia nuevas propuestas!</p>
                </div>
            </div>
        </div>
    </div>

    <br/><br/>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded m-auto p-1">
        <div class="collapse navbar-collapse" id="rafflesNavLeft">
            <div class="navbar-nav">
            <!-- request()->query('filter') -->
                <div class="nav-item rounded mr-1">
                    <form>
                        <input type="hidden" name="filter" value="">
                        <button class="btn nav-item nav-link w-100 {{ request()->query('filter') == '' ? 'active-filter' : '' }}">Nuevos</button>
                    </form>
                </div>

                <div class="nav-item rounded mx-1">
                    <form>
                        <input type="hidden" name="filter" value="mas_comprados">
                        <button class="btn nav-item nav-link w-100 {{ request()->query('filter') == 'mas_comprados' ? 'active-filter' : '' }}">Los mas comprados</button>
                    </form>
                </div>

                <div class="nav-item rounded mx-1">
                    <form>
                        <input type="hidden" name="filter" value="terminando">
                        <button class="btn nav-item nav-link w-100 {{ request()->query('filter') == 'terminando' ? 'active-filter' : '' }}">A punto de finalizar</button>
                    </form>
                </div>

                <!-- <div class="nav-item rounded mx-1">
                    <form>
                        <input type="hidden" name="filter" value="finalizados">
                        <button class="btn nav-item nav-link w-100 {{ request()->query('filter') == 'finalizados' ? 'active-filter' : '' }}">Finalizados</button>
                    </form>
                </div> -->

            </div>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="rafflesNavRight">
            <div class="navbar-nav">

                <div class="nav-item rounded mx-1">
                    <form>
                        <input type="hidden" name="filter" value="menor_costo">
                        <button class="btn nav-item nav-link w-100 {{ request()->query('filter') == 'menor_costo' ? 'active-filter' : '' }}">Menor costo</button>
                    </form>
                </div>

                <div class="nav-item rounded mx-1">
                    <form>
                        <input type="hidden" name="filter" value="mayor_costo">
                        <button class="btn nav-item nav-link w-100 {{ request()->query('filter') == 'mayor_costo' ? 'active-filter' : '' }}">Mayor costo</button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <div class="container-fluid pb-5">
        
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
                                <p class="text-danger font-weight-bold mb-1"><i class="fas fa-exclamation-triangle fa-sm"></i> Finaliza el {{ $raffle->end_date }}</p>
                                <h4 class="card-text font-weight-bold">{{ strlen($raffle->title) > 30 ? substr($raffle->title, 0, 30) . '...' : $raffle->title}}</p>
                                <p class="h5">{{ strlen($raffle->description) > 100 ? substr($raffle->description, 0, 100) . '...' : $raffle->description}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach

    </div>  
</div>
@endsection

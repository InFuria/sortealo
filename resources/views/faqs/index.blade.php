@extends('layouts.app')

@section('title', 'Preguntas Frecuentes')

@section('css')
<style>
    .list-group-item{
        color: black;
        text-decoration: none !important;
        font-size: 1.2rem;
    }

    li:hover{
        background-color: rgb(255,110,64, .7);
    }
    
    .btn-back{
        background-color: #1e3d59; 
        border-color: #1e3d59;
        color: white;
    }

    .btn-back:hover{
        background-color: rgb(255,110,64, .7);
        border-color: rgb(255,110,64, .7);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">

            @if(isset($categories) && !$categories->isEmpty())
                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <h1 class="ml-3 p-2 special-title mx-auto">Preguntas frecuentes</h1>
                    </div>
                </div>

                <h3 class="mx-auto">Categorias</h3>
                <div class="card-body col-11 mx-auto">
                    <div class="row col-12 ml-5 ">
                        <div class="card my-2 p-2 rounded col-12">
                            <ul class="list-group">
                                @foreach($categories as $category)

                                    @if(count($category->faqs) > 0)
                                        
                                        <a class="list-group-item" href="faqs?categoria={{ $category->name }}">{{ $category->name }}</a>
                                        
                                    @endif
                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            @elseif(isset($faqs) && $faqs !== [])

                <div class="row">
                <a class="btn btn-back btn-sm col-1 m-2" href="/faqs">Volver</a>
                    <div class="col-12 text-center mt-3">
                        <h1 class="ml-3 p-2 special-title mx-auto">Preguntas frecuentes</h1>
                    </div>
                </div>

                <h3 class="mx-auto">{{ $faqs->name }}</h3>
                <div class="card-body col-11 mx-auto">
                    <div class="row col-12 ml-5 ">
                        <div class="card my-2 p-2 rounded col-12">
                            <ul class="list-group">
                               @foreach($faqs->faqs as $faq)
                                <div class="list-group-item">
                                    <h4> <i class="fas fa-minus-square" style="font-size: 16px !important"></i> {{ $faq->question }}</h4>
                                    <p>{{ $faq->answer }}</p>
                                </div>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            @else
                <div class="text-center mt-5"><h1>No se han encontrado preguntas publicadas</h1></div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
 // Prevents menu from closing when clicked inside
 document.getElementById("Dropdown").addEventListener('click', function (event) {
            alert("click outside");
            event.stopPropagation();
        });
</script>
@append
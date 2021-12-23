@extends('layouts.app')

@section('title', 'Detalle de sorteo')

@section('css')
<style>
    .badge-h3 {
        font-size: 150% !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">

                <div class="card-body col-11 mx-auto">
                    
                    <div class="col-12 row">
                        <div class="col-7 mt-2">
                            <div id="carousel-{{ $raffle->id }}" class="carousel border-bottom border-dark slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @if(count($raffle->files) > 0)
                                        @foreach($raffle->files as $file)
                                            <div class="carousel-item {{ $raffle->files[0]->id == $file->id ? 'active' : '' }}">
                                                <img src="{{ asset('storage/raffles/' . $file->name) }}" class="d-block w-auto mx-auto" alt="{{ $raffle->title }}" style="height: 630px; max-height: 630px;">
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="carousel-item active">
                                        <img src="{{ asset('storage/raffles/no-disponible.png') }}" class="d-block w-auto mx-auto" alt="{{ $raffle->title }}" style="height: 630px; max-height: 630px;">
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
                        </div>

                        <div class="col-5 mt-3">
                            <h1>{{ $raffle->title }}</h1>

                            @if($raffle->status == 3 && isset($winners))
                            
                                @if($raffle->multiple_winners == 0)
                                    <h3 class="badge badge-h3 p-2">Ganador: <h3 class="badge badge-success badge-h3 p-2">{{ $winners[0]->client->name }}</h3></h3>
                                @else
                                    <h3 class="badge badge-h3 p-2">Ganadores:</h3>
                                    <br>
                                    @foreach($winners as $winner)
                                        <h3 class="badge badge-success badge-h3 p-2">{{ $winner->client->name }}</h3>
                                    @endforeach
                                @endif
                                
                            @endif

                            <br>
                            @if($raffle->end_date->gte(Carbon\Carbon::now()))
                            <p class="badge badge-info text-white p-2">Finaliza el {{ $raffle->end_date }}</p>
                            @else
                            <p class="badge badge-danger p-2">Este sorteo ya no esta disponible</p>   
                            @endif

                            @if($raffle->remaining > 0 && $raffle->end_date->gte(Carbon\Carbon::now()))
                            <p class="text-danger">Quedan {{ $raffle->remaining }} tickets disponibles</p>
                            @else
                            <p class="text-danger">No quedan tickets disponibles</p>
                            @endif

                            <div class="overflow-auto" style="height: 370px;">
                                <p class="h5">{{ $raffle->description }}</p>
                            </div>

                            @if($raffle->remaining > 0 && $raffle->end_date->gte(Carbon\Carbon::now()))

                                <h4 class="mb-4">Costo por ticket: <i>$ {{ $raffle->cost_per_ticket }}</i></h4>

                                <label for="quantity">Cantidad</label>
                                <div class="d-flex d-inline">
                                    <div class="d-flex d-inline border border-orange rounded">
                                        <button type="button" id="minus" class="btn bg-orange btn-sm rounded-0"><i class="fas fa-minus"></i></button>
                                        <div>
                                            <input type="text" class="py-2 px-4 border-0 text-center" step="1" min="1" name="quantity" value="1" title="Cantidad" size="2" inputmode="numeric" id="quantity-input">
                                        </div>
                                        <button type="button"id="plus"  class="btn bg-orange btn-sm rounded-0"><i class="fas fa-plus"></i></button>
                                    </div>

                                    <button id="add-to-cart" class="btn bg-orange ml-3" data-raffle="{{ $raffle->id }}" name="add-to-cart">
                                        Agregar al carrito
                                    </button>
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){

        /* Botones de cantidad de ticket */
        $('#plus').on('click', function(e){

            let quantity = $('#quantity-input');

            let total = Number(quantity.val()) + 1;

            quantity.val(total);
        });

        $('#minus').on('click', function(e){

            let quantity = $('#quantity-input');

            if(Number(quantity.val()) > 1){
                let total = Number(quantity.val()) - 1;

                quantity.val(total);
            }
            
        });


        /* Manejo de agregar tickets al carrito */
        $('#add-to-cart').on('click', function(e){
            
            let quantity = $('#quantity-input').val();
            let raffle = $(this).data('raffle');

            $.ajax({
                type: 'post',
                data: {'id': raffle, 'quantity': quantity, "_token": $("meta[name='csrf-token']").attr("content")},
                async: false,
                url: '{{ route("cart.addtoCart") }}',
                success:function(response) {

                    jQuery.noConflict();

                    let newItemData = response.find(x => x.raffle_id === raffle);
                    let tickets = 0;

                    let photo = '{{ asset("storage/raffles/") }}/' + newItemData.photo;

                    let item = $('<div class="cart-block-item border-bottom row" id="'+ newItemData.raffle_id +'" style="max-height: 100px; height:100px">'+
                        '<div class="col-md-3"><img src="'+ photo +'" width="100%" class=""></div>'+
                            '<div class="col-md-9 d-flex align-items-center">' +
                                '<p class="title mb-0">'+ newItemData.title +'</p>' +
                                '<p class="col-4 mb-0 mr-0" id="'+ newItemData.raffle_id +'-price">'+ newItemData.quantity +' x $ '+ newItemData.price +'</p>' +

                                '<a title="Quitar del carrito" type="button" class="btn-close btn-close-sm btn-delete-product text-muted btn btn-link btn-sm mb-0" data-id="">' +
                                    '<i class="far fa-times-circle"></i>'+
                                '</a>'+
                            '</div>'+
                        '</div>');

                    /* Verifica si es el primero o ya hay otros antes */
                    if(response.length <= 1){

                        let total = newItemData.quantity * newItemData.price;
                        tickets= newItemData.quantity;

                        $('.cart-full-container').empty();
                        $('.cart-full-container').append('<div class="cart-container"></div>');

                        let footer = $('<div class="card-footer">'+
                            '<div class="d-flex align-items-center">'+
                                '<p class="mb-0 col-4" id="total">Total: <b>$ 0</b></p>'+
                                '<a class="dropdown-item border border-orange cart-button col-3" id="reset-cart" href="#" style="border-radius: 32px;">Limpiar</a>'+
                                '<a class="dropdown-item border border-orange cart-button col-5" id="finishBuying" href="/cart/preview" style="border-radius: 32px;">Finalizar compra</a>'+
                            '</div></div>');

                        $('.cart-container').append(item);
                        $(".cart-full-container").append(footer);

                        $('#total > b').text('$ ' + total);


                        $(".cart-full-container").dropdown('toggle');

                    } else {

                        let total = 0;
                        tickets = 0;

                        $.each(response, function(index, value){
                            total += value.subTotal;
                            tickets += Number(value.quantity);
                        });

                        let itemsInCart = $('.cart-container').children();
                        $.each(itemsInCart, function(index, node){
                            
                            let itemId = $(node).attr('id');

                            if(itemId == newItemData.raffle_id){

                                $(node).replaceWith(item);

                            } else {

                                $('.cart-container').append(item);
                                $('#total > b').text('$ ' + total);
                                $(".cart-full-container").dropdown('toggle');

                            }

                        });
                    }


                    /* Alerta */
                    Swal.fire({
                        title: '<strong><u>¡Agregado al Carrito!</u></strong>',
                        icon: 'success',
                        html:
                            'Ahora mismo tiene ' + response.length + ' productos y ' + tickets + ' tickets en su carrito',
                        showCloseButton: true,
                        showCancelButton: false,
                        showDenyButton: true,
                        confirmButtonColor: '#ff6e40',
                        denyButtonColor: '#6c757d',
                        focusConfirm: false,
                        confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Continuar!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        denyButtonText: 'Terminar compra',
                    }).then((result) => {
                        if (result.isDenied) {
                            window.location = "/cart/preview";
                        }
                    })
                }
            });
        })
    });
</script>
@append
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('img/logos/logo.png') }}">
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>

        .carousel-control-prev-icon, .carousel-control-next-icon{
            width: 20px !important;
            height: 20px !important;
        }

        .carousel-control {
            height: 30px;
            width: 30px;
            border-radius: 40px;
            background-color: #fd834f;
        }

        body {           
            background-image: url("{{ asset('img/logos/back.png')}}");
            background-repeat: no-repeat;
            background-size: cover;  
            /* height: 100%; */
        }

        .nav-link {
            color:#f5f0e1;
        }

        ul li a.nav-link:hover, li a.nav-link:hover, a.nav-link:hover{
            background-color: rgb(255,110,64, .7);
            color:#ffffff !important;
        }

        div.nav-item > form > button.nav-item:hover{
            background-color: rgb(255,110,64, .7);
            color: #ffffff !important;
        }

        .special-card {
            opacity: .85;
        }

        .nav-pills .nav-link.active {
            background-color: #ff6e40;
        }

        .special-title {
            font-family: sans-serif;
        }

        body{
            background-color: #f8f9fa!important
        }

        .p-4 {
            padding: 1.5rem!important;
        }

        .mb-0, .my-0 {
            margin-bottom: 0!important;
        }
        
        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
        }    

        /* user-dashboard-info-box */
        .user-dashboard-info-box .candidates-list .thumb {
            margin-right: 20px;
        }
        .user-dashboard-info-box .candidates-list .thumb img {
            width: 80px;
            height: 80px;
            -o-object-fit: cover;
            object-fit: cover;
            overflow: hidden;
            border-radius: 50%;
        }

        .user-dashboard-info-box .title {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: 30px 0;
        }

        .user-dashboard-info-box .candidates-list td {
            vertical-align: middle;
        }

        .user-dashboard-info-box td li {
            margin: 0 4px;
        }

        .user-dashboard-info-box .table thead th {
            border-bottom: none;
        }

        .table.manage-candidates-top th {
            border: 0;
        }

        .user-dashboard-info-box .candidate-list-favourite-time .candidate-list-favourite {
            margin-bottom: 10px;
        }

        .table.manage-candidates-top {
            min-width: 650px;
        }

        .user-dashboard-info-box .candidate-list-details ul {
            color: #969696;
        }

        /* Candidate List */
        .candidate-list {
            background: #ffffff;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            border-bottom: 1px solid #eeeeee;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: 20px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
        .candidate-list:hover {
            -webkit-box-shadow: 0px 0px 34px 4px rgba(33, 37, 41, 0.06);
            box-shadow: 0px 0px 34px 4px rgba(33, 37, 41, 0.06);
            position: relative;
            z-index: 99;
        }
        .candidate-list:hover a.candidate-list-favourite {
            color: #e74c3c;
            -webkit-box-shadow: -1px 4px 10px 1px rgba(24, 111, 201, 0.1);
            box-shadow: -1px 4px 10px 1px rgba(24, 111, 201, 0.1);
        }

        .candidate-list .candidate-list-image {
            margin-right: 25px;
            -webkit-box-flex: 0;
            -ms-flex: 0 0 80px;
            flex: 0 0 80px;
            border: none;
        }
        .candidate-list .candidate-list-image img {
            width: 80px;
            height: 80px;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .candidate-list-title {
            margin-bottom: 5px;
        }

        .candidate-list-details ul {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-bottom: 0px;
        }
        .candidate-list-details ul li {
            margin: 5px 10px 5px 0px;
            font-size: 13px;
        }

        .candidate-list .candidate-list-favourite-time {
            margin-left: auto;
            text-align: center;
            font-size: 13px;
            -webkit-box-flex: 0;
            -ms-flex: 0 0 90px;
            flex: 0 0 90px;
        }
        .candidate-list .candidate-list-favourite-time span {
            display: block;
            margin: 0 auto;
        }
        .candidate-list .candidate-list-favourite-time .candidate-list-favourite {
            display: inline-block;
            position: relative;
            height: 40px;
            width: 40px;
            line-height: 40px;
            border: 1px solid #eeeeee;
            border-radius: 100%;
            text-align: center;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px;
            font-size: 16px;
            color: #646f79;
        }
        .candidate-list .candidate-list-favourite-time .candidate-list-favourite:hover {
            background: #ffffff;
            color: #e74c3c;
        }

        .candidate-banner .candidate-list:hover {
            position: inherit;
            -webkit-box-shadow: inherit;
            box-shadow: inherit;
            z-index: inherit;
        }

        .bg-white {
            background-color: #ffffff !important;
        }
        .p-4 {
            padding: 1.5rem!important;
        }
        .mb-0, .my-0 {
            margin-bottom: 0!important;
        }
        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
        }

        .user-dashboard-info-box .candidates-list .thumb {
            margin-right: 20px;
        }

        .sidebar-link{
            width: 4.2rem;
        }

        .carousel-item img {
            max-height: 250px;
        }

        .bg-orange{
            background-color: #ff6e40;
            color: white !important;
        }

        .border-orange{
            border-color: #ff6e40 !important;
        }

        .cart-button:hover{
            background-color: #ff6e40;
            color: white !important;
        }

        .overflow-cart {
            overflow-x: hidden;
            overflow-y: auto !important;
        }
    </style>

    @yield('css')

    <!-- HEAD -->
    {!! htmlScriptTagJsApi() !!}
</head>
<body>
    <div id="app">
    @include('sweetalert::alert')
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-lg">
            <div class="container-fluid row bg-light">
                <a class="navbar-brand d-flex float-left pl-5 pr-3 pl-0" href="{{ url('/') }}">
                    <img class="pr-3 pl-0 pt-0 pb-0" src="{{ asset('/img/logos/logo.png') }}" width="50px" style="border-right: 1px #fd834f solid;"/>

                    <span class="h3 ml-3 mt-2">Sortealo</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="col-3 ml-5 mt-2" >
                    <form class="form-inline col-12">
                        <!-- <input class="form-control col-12" type="search" placeholder="Ingrese un nombre de sorteo o producto" aria-label="Search"> -->
                    </form>
                </div>

                <div class="collapse navbar-collapse h4" id="navbarNavDropdown">
                    <ul class="navbar-nav pt-3 d-flex justify-content-between">
                        <li class="nav-item px-4 {{ \Request::route()->getName() == 'home' ? 'active' : '' }}">
                            <a class="nav-link rounded" href="/">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <!-- <li class="nav-item px-4">
                            <a class="nav-link" href="{{ route('home') }}">Sorteos</a>
                        </li> -->
                        <li class="nav-item px-4 {{ \Request::route()->getName() == 'raffles.results' ? 'active' : '' }}">
                            <a class="nav-link rounded" href="{{ route('raffles.results') }}">Resultados</a>
                        </li>
                        <li class="nav-item px-4 {{ \Request::route()->getName() == 'faqs.index' ? 'active' : '' }}">
                            <a class="nav-link rounded" href="{{ route('faqs.index') }}">FAQ</a>
                        </li>
                        <li class="nav-item px-4 {{ \Request::route()->getName() == 'contact.index' ? 'active' : '' }}">
                            <a class="nav-link rounded" href="{{ route('contact.index') }}">Contacto</a>
                        </li>
                        @guest
                        <li class="nav-item {{ \Request::route()->getName() == 'login' ? 'active' : '' }}" style="margin-right: 0;">
                            <a class="nav-link rounded" href="/panel">Team</a>
                        </li>
                        @endguest
                    </ul>
                </div>

                <div class="collapse navbar-collapse h4 d-flex justify-content-right" id="navbarNavDropdown">
                    <ul class="navbar-nav  pt-3 ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link rounded" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-shopping-cart"></i></a>

                                <div class="dropdown-menu dropdown-menu-right cart-full-container rounded px-2" style="width: 25rem;" data-id="">

                                    @if(session()->get(session()->getId().'-') !== null && count(session()->get(session()->getId().'-')) > 0) <!-- se verifica si ya se trae algo por sesion -->

                                        <div class="cart-container overflow-cart" style="max-height: 25rem;">
                                            @foreach(session()->get(session()->getId().'-') as $item)
                                                <div class="cart-block-item border-bottom row" id="{{ $item['raffle_id'] ?? '' }}" style="max-height: 100px; height:100px">
                                                    <div class="col-md-3 d-flex mx-auto">
                                                        <img src="{{ asset('storage/raffles/' . $item['photo']) }}" width="100%"> 
                                                    </div>
                                                    <div class="col-md-9 d-flex align-items-center">
                                                        <p class="title mb-0">{{ $item['title'] ?? '' }}</p>
                                                        <p class="col-4 mb-0 mr-0" id="{{ $item['raffle_id'] ?? '' }}-price">{{ $item['quantity'] ?? '' }} x $ {{ $item['price'] ?? '' }}</p>

                                                        <a title="Quitar del carrito" type="button" class="btn-close btn-close-sm btn-delete-product text-muted btn btn-link btn-sm mb-0" data-id="">
                                                            <i class="far fa-times-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="card-footer">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 col-4" id="total">Total: <b>$ 0</b></p>
                                                <a class="dropdown-item border border-orange cart-button col-3" id="reset-cart" href="#" style="border-radius: 32px;">Limpiar</a>
                                                <a class="dropdown-item border border-orange cart-button col-5" id="finishBuying" href="/cart/preview" style="border-radius: 32px;">Finalizar compra</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="cart-empty">
                                            <div class="cart-block-item d-flex align-items-center justify-content-center mt-3">
                                                <p>Aun no agrego tickets</p>
                                            </div>

                                            <div class="dropdown-divider" style="height: 0px; margin: 0.5rem 0px; overflow: hidden; border-top: 1px solid rgba(0, 0, 0, 0.15);"></div>

                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 col-4" id="total">Total: <b>$ 0</b></p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle rounded" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('panel.index') }}">Panel</a>

                                    <a class="dropdown-item" href="{{ route('users.profile', ['user' => Auth::user()->id]) }}">Perfil</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>

    @yield('js')

    <!-- Importacion para constante de alertas -->
    <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>

    <script>

        /* Constante de alerta desde js */
        const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

        $(document).ready(function(){

            /* Cargar el total del carrito indistintamente de donde este */
            $.ajax({
                type: 'get',
                url: '{{ route("cart.loadCart") }}',
                success:function(response) {

                    jQuery.noConflict();

                    let total = 0;
                    $.each(response, function(index, value){
                        total += value.subTotal;
                    });

                    $('p#total > b').text('$ ' + total);

                }, error: function(data){

                    var responseText=JSON.parse(data.responseText);
                    console.log('Respuesta del reset de carrito: ' + responseText);

                    Toast.fire({
                        icon: 'error',
                        title: 'Hubo un error al cargar el carrito!'
                    })
                }
            });

            /* Eliminar un producto del carrito indistintamente de donde este */
            $('.cart-full-container').on('click', '.btn-delete-product',function(e){

                let raffle_id = $(this).parents('.cart-block-item').attr('id');

                $.ajax({
                    type: 'post',
                    data: {"_token": $("meta[name='csrf-token']").attr("content"), id: raffle_id},
                    url: '{{ route("cart.deleteItemCart") }}',
                    success:function(response) {

                        jQuery.noConflict();

                        if(response == false){
                            Toast.fire({
                            icon: 'error',
                            title: 'Hubo un error al cargar el carrito!'
                            })
                        }

                        $('.cart-full-container').empty();
                        $('.cart-full-container').append('<div class="cart-container"></div>');

                        if(response.length >= 1){ //Si quedan otros productos que mostrar

                            $.each(response, function(index, value){

                            let newItemData = value;
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

                            $('.cart-container').append(item);
                            });


                            let total = 0;
                            $.each(response, function(index, value){
                            total += value.subTotal;
                            });

                            let footer = $('<div class="card-footer">'+
                            '<div class="d-flex align-items-center">'+
                                '<p class="mb-0 col-4" id="total">Total: <b>$ ' + total + '</b></p>'+
                                '<a class="dropdown-item border border-orange cart-button col-3" id="reset-cart" href="#" style="border-radius: 32px;">Limpiar</a>'+
                                '<a class="dropdown-item border border-orange cart-button col-5" id="finishBuying" href="/cart/preview" style="border-radius: 32px;">Finalizar compra</a>'+
                            '</div></div>');

                            $('.cart-full-container').append(footer);

                        } else {

                            let container = $('.cart-full-container');
                            container.empty();

                            let empty = $('<div class="cart-block-item d-flex align-items-center justify-content-center mt-3"><p>Aun no agrego tickets</p></div>'+
                                '<div class="dropdown-divider" style="height: 0px; margin: 0.5rem 0px; overflow: hidden; border-top: 1px solid rgba(0, 0, 0, 0.15);"></div>'+
                                '<div class="d-flex align-items-center"><p class="mb-0 col-4">Total: <b>$ 0</b></p></div>');

                            container.append(empty);
                        }
                        
                        $(".cart-full-container").dropdown('toggle');

                        Toast.fire({
                            showCloseButton: true,
                            icon: 'success',
                            title: 'Se elimino el producto del carrito!'
                        })

                    }, error: function(data){

                        var responseText=JSON.parse(data.responseText);
                        console.log('Respuesta del reset de carrito: ' + responseText);

                        Toast.fire({
                            icon: 'error',
                            title: 'Hubo un error al cargar el carrito!'
                        })
                    }
                });
            });
            

            $('.dropdown-menu').click(function(e) {
                e.stopPropagation();
            });

            /* Eliminacion de productos seleccionados en el carrito */
            $('.btn-delete-product').on('click', function(e){
                let id = $(this).data('id');
            });

            /* Corrige error de links generados */
            $('.cart-full-container').on('click', '#finishBuying', function(e){
                window.location.href = "/cart/preview";
            });


            /* Limpiar carrito */
            $('.cart-full-container, #reset-cart').on('click', '#reset-cart',function(e){
                $.ajax({
                    type: 'post',
                    data: {"_token": $("meta[name='csrf-token']").attr("content")},
                    url: '{{ route("cart.resetCart") }}',
                    success:function(response) {

                        jQuery.noConflict();

                        let container = $('.cart-full-container');
                        container.empty();

                        let empty = $('<div class="cart-block-item d-flex align-items-center justify-content-center mt-3"><p>Aun no agrego tickets</p></div>'+
                        '<div class="dropdown-divider" style="height: 0px; margin: 0.5rem 0px; overflow: hidden; border-top: 1px solid rgba(0, 0, 0, 0.15);"></div>'+
                        '<div class="d-flex align-items-center"><p class="mb-0 col-4">Total: <b>$ 0</b></p></div>');

                        container.append(empty);

                        $(".cart-full-container").dropdown('toggle');

                        Toast.fire({
                            showCloseButton: true,
                            icon: 'success',
                            title: 'Se limpio el carrito!'
                        })
                    }, error: function(data){

                        var responseText=JSON.parse(data.responseText);
                        console.log('Respuesta del reset de carrito: ' + responseText);

                        Toast.fire({
                            icon: 'error',
                            title: 'No se pudo limpiar el carrito!'
                        })
                    }
                });
            });
        });
    </script>
</body>
</html>

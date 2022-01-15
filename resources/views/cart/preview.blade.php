@extends('layouts.app')

@section('title', 'Detalle de Carrito')

@section('css')
<style>
.wrapper {
  overflow: auto;
  border-radius: 13px;
  border: 1px solid #dee2e6;
}

table {
  border-spacing: 0;
  border-collapse: collapse;
  border-style: hidden;

  width:100%;
  max-width: 100%;
}

.border-16 {
    border-radius: 16px;
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
                    <div class="mt-4 mb-4">
                        <h1 class="ml-3 p-4 d-inline special-title" style="color: #4d4d4d;">Carrito de Compra</h1>
                    </div>
                </div>

                <div class="col-md-12 row">

                    @if($details !== null) 
                        <div class="col-9 user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12 wrapper px-0">
                            
                                <h4 class="px-4 py-3">Mi lista de productos</h4>
                                <table class="table wrapper mb-0 table-hover mb-0" id="users-table">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Sorteo</th>
                                            <th class="text-center col-2">Cantidad</th>
                                            <th class="text-center col-1">Precio x ticket</th>
                                            <th class="text-center col-1">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>   
                                        @foreach($details as $item)
                                            <tr>
                                                <td class="text-left">
                                                    <div class="row d-flex">
                                                        <div class="col-2 d-flex ml-0 mr-auto">
                                                            <img src="{{ asset('storage/raffles') }}/{{ $item['photo'] }}" width="100%" class="" style="max-height: 100px; height:100px">
                                                        </div>
                                                        <div class="col-10 d-flex my-auto">
                                                            <p>{{ $item['title'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center col-2 align-middle">
                                                    <div class="d-flex d-inline justify-content-center">
                                                        <button type="button" id="minus" class="btn border-16 bg-orange btn-sm"><i class="fas fa-minus fa-sm"></i></button>
                                                        <div>
                                                            <input type="text" class="border-0 text-center" step="1" min="1" name="quantity" value="{{ $item['quantity'] }}" title="Cantidad" size="2" inputmode="numeric" id="quantity-input">
                                                        </div>
                                                        <button type="button"id="plus" class="btn border-16 bg-orange btn-sm"><i class="fas fa-plus fa-sm"></i></button>
                                                    </div>
                                                </td>
                                                <td class="text-center col-1 align-middle">USD. {{ $item['price'] }}</td>
                                                <td class="text-center col-1 align-middle">USD. {{ $item['subTotal'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="p-3">
                                    <form action="{{ route('cart.resetCart') }}" method="POST">
                                        @csrf
                                        <button class="btn text-danger border-danger bg-light border-16" id="reset-cart-preview">Vaciar carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12 wrapper px-0">
                                <h4 class="px-4 py-3">Resumen del carrito</h4>
                                <table class="table wrapper mb-0 table-hover mb-0" id="users-table">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Total Tickets</th>
                                            <td data-title="Subtotal">
                                                <span class="ecommercepro-Price-amount amount" id="cart-subtotal">{{ $quantity }}</span>
                                            </td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th>Tipo de pago</th>
                                            <td data-title="Subtotal">
                                            <div class="form-group">
                                                <div class="col-md-12 px-0">
                                                    <select class="form-control form-control-sm" name="payment_type" id="payment_type">
                                                        <option value="null">Seleccione un metodo de pago</option>
                                                        <option value="1">Efectivo</option>
                                                        <option value="1">Tarjeta</option>
                                                    </select>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td data-title="Total">
                                                <strong>
                                                    <span class="ecommercepro-Price-amount amount" id="cart-total">{{ $total }}</span>
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="p-3">
                                    <button class="btn btn-success border-success border-16" style="border-radius: 16px;">Comprar Ya</button>
                                    <a class="btn btn-info border-info text-white border-16" href="/" style="border-radius: 16px;">Agregar más productos</a>
                                </div>
                            </div>
                        </div>

                    @else
                    <div class="col-12 user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                        <div class="col-12 wrapper px-0">
                            <table class="table wrapper mb-0 table-hover mb-0" id="users-table">
                                <tr><td><h4 class="p-4">Aun no se han cargado productos al carrito</h4></td></tr>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
       
    });
</script>
@append
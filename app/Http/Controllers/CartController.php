<?php

namespace App\Http\Controllers;

use App\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/* Se debe agregar un guion al id de session cada vez que se quiera usar, ya que al usar el id de sesion de laravel los datos no persisten, pero al agregar algo a ese id se vuelve un identificador normal */
class CartController extends Controller
{
    /* Carga los valores actuales en el carrito, puede usarse para un refresh */
    public function loadCart(Request $request)
    {
        try{

            if($request->ajax()){

                $idCart = session()->getId();

                return response()->json(Session::get($idCart.'-'));
            }
            
            return response()->json(false);

        } catch(\Throwable $e){
            Log::error('CartController::loadCart - ' . $e->getMessage());
            return response()->json(false);
        }
    }

    /* Agrega valores al carrito */
    public function addToCart(Request $request)
    {
        try{

            if($request->ajax()){

                $idCart = session()->getId();
                $raffle = Raffle::where('id', $request->id)->first();
                $photo = count($raffle->files) > 0 ? $raffle->files[0]['name']: 'no-disponible.png';
                $total = $request->quantity * $raffle->cost_per_ticket;

                /* Se verifica si el producto existe ya en la sesion */
                $actualItems = session()->get(session()->getId().'-');

                if($actualItems !== null){
                    $actualItems = array_values($actualItems);

                    $search = array_search($request->id, array_column($actualItems, 'raffle_id'));
                    if($search !== false){
                        $actualItems[$search]['quantity'] = $actualItems[$search]['quantity'] + $request->quantity;
                        $actualItems[$search]['subTotal'] = $actualItems[$search]['subTotal'] + $total;

                    } else {
                        array_push($actualItems, ['idCart' => $idCart . '-', 'raffle_id' => $raffle->id, 'quantity' => request()->quantity, 'price' => $raffle->cost_per_ticket, 'title' => $raffle->title, 'photo' => $photo, 'subTotal' => $total]);
                    }
                } else {

                    $actualItems = [];
                    array_push($actualItems, ['idCart' => $idCart . '-', 'raffle_id' => $raffle->id, 'quantity' => request()->quantity, 'price' => $raffle->cost_per_ticket, 'title' => $raffle->title, 'photo' => $photo, 'subTotal' => $total]);
                }
                
                Session::put($idCart.'-', $actualItems);
                Session::save();

                return response()->json(Session::get($idCart.'-'));
            }
            
            return response()->json(false);

        } catch(\Throwable $e){
            Log::error('CartController::addToCart - ' . $e->getMessage() . ' | line :  ' . $e->getLine());
            return response()->json(false);
        }
    }

    /* Elimina un obejeto de la sesion del carrito */
    public function deleteItemCart(Request $request)
    {
        try{

            if($request->ajax()){

                $idCart = session()->getId();

                /* Se verifica si el producto existe ya en la sesion */
                $actualItems = session()->get(session()->getId().'-');
                if($actualItems !== null){
                    $search = array_search($request->id, array_column($actualItems, 'raffle_id'));

                    if($search !== false){
                        unset($actualItems[$search]);

                    }
                }

                $actualItems = array_values($actualItems);

                Session::put($idCart.'-', $actualItems);
                Session::save();

                return response()->json(Session::get($idCart.'-'));
            }
            
            return response()->json(false);

        } catch(\Throwable $e){
            Log::error('CartController::addToCart - ' . $e->getMessage());
            return response()->json(false);
        }
    }

    /* Limpia todos los registro de la sesion del carrito */
    public function resetCart(Request $request)
    {
        try{

            $idCart = session()->getId();
            session()->forget($idCart . '-');

            if($request->ajax()){
                return response()->json(true);
            }
            
            return redirect()->to('/')->with('toast_success', 'Se ha vaciado el carrito!');

        } catch(\Throwable $e){
            Log::error('CartController::addToCart - ' . $e->getMessage());
            return response()->json(false);
        }
    }

    public function preview()
    {
        try{

            $idCart = session()->getId();
            $details = Session::get($idCart.'-');

            $quantity = 0; $total = 0;
            foreach($details as $detail){
                $quantity = $quantity + $detail['quantity'];
                $total = $total + $detail['subTotal'];
            }
            
            return view('cart.preview', compact('details', 'quantity', 'total'));

        } catch(\Throwable $e){
            Log::error('CartController::preview - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }
}

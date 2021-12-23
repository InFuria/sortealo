<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\RaffleType;

class RaffleTypeController extends Controller
{

    public function index()
    {
        try{

            if(request()->ajax()){
                $types = RaffleType::where('name',  'LIKE','%'. request()->search .'%')->orderBy('updated_at', 'DESC')->withCount(['raffles'])->paginate(15);

                return response()->json($types);
            }

            $types = RaffleType::orderBy('updated_at', 'DESC')->withCount(['raffles'])->paginate(15);

            return view('raffleTypes.index', compact('types'));

        } catch(\Throwable $e){
            Log::error('RaffleTypeController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function store(Request $request)
    {
        try{

            $validated = $request->validate([
                'name' => 'required|string'
            ]);

            $raffleType = new RaffleType();
            $raffleType->name = $validated['name'];
            $raffleType->save();

            return redirect()->to('raffleTypes')->with("toast_success", "Se ha creado una nueva categoria!");

        } catch(\Throwable $e){
            Log::error('RaffleTypeController::store - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al crear la categoria");
        }
    }


    public function update(Request $request, RaffleType $raffleType)
    {
        try{

            $validated = $request->validate([
                'name' => 'string'
            ]);

            $raffleType->name = isset($validated['name']) ? $validated['name'] : $raffleType->name;
            $raffleType->save();

            return redirect()->to('raffleTypes')->with("toast_success", "Se ha actualizado la categoria!");

        } catch(\Throwable $e){
            Log::error('RaffleTypeController::update - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al actualizar la categoria");
        }
    }


    public function destroy(RaffleType $raffleType)
    {
        try{

            $raffleType->delete();

            return redirect()->to('raffleTypes')->with("Se ha eliminado la categoria!");

        } catch(\Throwable $e){
            Log::error('RaffleTypeController::destroy - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al eliminar la categoria");
        }
    }

    public function getType(){
        try{

            $id = request()->id;

            if(isset($id)){

                $type = RaffleType::where('id', $id)->first();

                return response()->json($type);

            } else {
                return response()->json(false);
            }

        } catch(\Throwable $e){
            Log::error('RaffleTypeController::getType - ' . $e->getMessage());
            return response()->json(false);
        }
    }
}

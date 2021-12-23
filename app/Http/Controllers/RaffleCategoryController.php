<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\RaffleCategory;

class RaffleCategoryController extends Controller
{
     public function index()
    {
        try{

            if(request()->ajax()){
                $categories = RaffleCategory::where('name',  'LIKE','%'. request()->search .'%')->orderBy('updated_at', 'DESC')->withCount(['raffles'])->paginate(15);

                return response()->json($categories);
            }

            $categories = RaffleCategory::orderBy('updated_at', 'DESC')->withCount(['raffles'])->paginate(15);

            return view('raffleCategories.index', compact('categories'));

        } catch(\Throwable $e){
            Log::error('RaffleCategoryController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function store(Request $request)
    {
        try{

            $validated = $request->validate([
                'name' => 'required|string'
            ]);

            $raffleType = new RaffleCategory();
            $raffleType->name = $validated['name'];
            $raffleType->save();

            return redirect()->to('raffleCategories')->with("toast_success", "Se ha creado una nueva categoria!");

        } catch(\Throwable $e){
            Log::error('RaffleCategoryController::store - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al crear la categoria");
        }
    }


    public function update(Request $request, RaffleCategory $raffleCategory)
    {
        try{

            $validated = $request->validate([
                'name' => 'string'
            ]);

            $raffleCategory->name = isset($validated['name']) ? $validated['name'] : $raffleCategory->name;
            $raffleCategory->save();

            return redirect()->to('raffleCategories')->with("toast_success", "Se ha actualizado la categoria!");

        } catch(\Throwable $e){
            Log::error('RaffleCategoryController::update - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al actualizar la categoria");
        }
    }


    public function destroy(RaffleCategory $raffleCategory)
    {
        try{

            $raffleCategory->delete();

            return redirect()->to('raffleCategories')->with("Se ha eliminado la categoria!");

        } catch(\Throwable $e){
            Log::error('RaffleCategoryController::destroy - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al eliminar la categoria");
        }
    }

    public function getCategory(){
        try{

            $id = request()->id;

            if(isset($id)){

                $category = RaffleCategory::where('id', $id)->first();

                return response()->json($category);

            } else {
                return response()->json(false);
            }

        } catch(\Throwable $e){
            Log::error('RaffleCategoryController::getCategory - ' . $e->getMessage());
            return response()->json(false);
        }
    }
}

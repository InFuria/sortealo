<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Raffle;
use App\RaffleCategory;
use App\RaffleStatus;

class ReportController extends Controller
{

    public function index(){
        try{
            
            return view('reports.index');

        } catch(\Throwable $e){
            Log::error('ReportController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }

    public function raffles(){
        try{
            
            $companies = Company::orderBy('name', 'ASC')->pluck('name', 'id');
            $companies->prepend('Todas', '0');

            $categories = RaffleCategory::orderBy('name', 'ASC')->pluck('name', 'id');
            $categories->prepend('Todas', '0');

            $statuses = RaffleStatus::pluck('name', 'id');
            $statuses->prepend('Todos', '0');

            $listTypesWinners = ["0" => "Todos", "1" => "Un solo ganador", "2" => "Multiples ganadores"];

            $typesOrder = ["recent" => "Mas reciente", "created" => "Orden creacion", "status" => "Estado"];


            /* Retorna resultados con filtros */
            if(request()->all() !== []){
                
                $start_date     = request()->start_date;
                $end_date       = request()->end_date;
                $company        = request()->company_id;
                $category       = request()->category_id;
                $status         = request()->status;
                $type_winners   = request()->type_winners;

                $results = Raffle::get();
               
            }

            /* Retorna resultados iniciales */
            $results = Raffle::orderBy('created_at', 'ASC')->with(['creator', 'company', 'category'])->paginate(20);

            return view('reports.raffles', compact('companies', 'categories', 'statuses', 'listTypesWinners', 'typesOrder', 'results'));

        } catch(\Throwable $e){
            Log::error('ReportController::raffles - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }

    public function raffleDetail(Raffle $raffle){
        try{
            
            //

        } catch(\Throwable $e){
            Log::error('ReportController::raffleDetail - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }
}

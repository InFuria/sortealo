<?php

namespace App\Http\Controllers;

use App\Raffle;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    public function index(Request $request){
        try{

            $ticketsTransactions = [];
            $filter = \Request::query() !== [] ? \Request::query()['filter'] : '';

            if(Auth::user()->role_id == 2){ // Resultado para empresas

                $registeredRaffles = Raffle::join('raffle_statuses', 'raffles.status', '=', 'raffle_statuses.id')->where('raffles.company_id', Auth()->user()->company->id)->selectRaw("count(raffles.id) as size, raffle_statuses.name as sector")->groupBy('status');

                /* Trae todas las fechas con compras de tickets registradas por empresa */
                $registeredTickets = DB::table('raffle_clients')->join('raffles', 'raffle_clients.raffle_id', '=', 'raffles.id')->where('raffles.company_id', Auth()->user()->company->id)->select("orderable_date")
                ->orderBy('orderable_date', 'ASC')->groupBy('orderable_date');

                /* Trae todos los registros de tickets en un array por empresa */
                $listTransactions = DB::table('raffle_clients')->join('raffles', 'raffle_clients.raffle_id', '=', 'raffles.id')->where('raffles.company_id', Auth()->user()->company->id)->selectRaw("count(*) as count, orderable_date, paid")
                ->groupBy('orderable_date')->groupBy('paid')->get();

                $movements      = null;
                $companiesUsers = null;

            } else { // Resultados para admin y staff

                $registeredRaffles = Raffle::join('raffle_statuses', 'raffles.status', '=', 'raffle_statuses.id')->selectRaw("count(raffles.id) as size, raffle_statuses.name as sector")->groupBy('status');

                $registeredTickets  = DB::table('raffle_clients')->join('raffles', 'raffle_clients.raffle_id', '=', 'raffles.id')->select("orderable_date")->orderBy('orderable_date', 'ASC')->groupBy('orderable_date');
                $listTransactions   = DB::table('raffle_clients')->join('raffles', 'raffle_clients.raffle_id', '=', 'raffles.id')->selectRaw("count(*) as count, orderable_date, paid")->groupBy('orderable_date')->groupBy('paid')->get();

                $movements          = Raffle::join('companies', 'raffles.company_id', '=', 'companies.id')->selectRaw("count(*) as count, raffles.created_at, companies.name as company")->groupBy('company_id');

                $companiesUsers     = Raffle::join('users', 'raffles.created_by', '=', 'users.id')->selectRaw("count(raffles.id) as count, username, photo")->groupBy('created_by');
            }

            if(isset($request->filter)){

                switch($request->filter){
                    case "1": /* Mes actual */
                    default:

                        $registeredRaffles = $registeredRaffles->where('raffles.created_at', '>', Carbon::now()->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->get();
                        $registeredTickets = $registeredTickets->where('orderable_date', '>', Carbon::now()->startOfMonth()->toDateString())->where('orderable_date', '<', Carbon::now()->endOfMonth()->toDateString())->pluck('orderable_date');
                        $movements         = $movements !== null ? $movements->where('raffles.created_at', '>', Carbon::now()->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->take(15)->get() : null;
                        $companiesUsers    = $companiesUsers !== null ? $companiesUsers->where('raffles.created_at', '>', Carbon::now()->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->take(15)->get() : null;

                        $month = Carbon::now()->locale('es_ES');
                        $title = ucfirst($month->monthName);

                        break;

                    case "2": /* Semestral */

                        $registeredRaffles = $registeredRaffles->where('raffles.created_at', '>', Carbon::now()->subMonths(6)->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->get();
                        $registeredTickets = $registeredTickets->where('orderable_date', '>', Carbon::now()->subMonths(6)->startOfMonth()->toDateString())->where('orderable_date', '<', Carbon::now()->endOfMonth()->toDateString())->pluck('orderable_date');
                        $movements         = $movements !== null ? $movements->where('raffles.created_at', '>', Carbon::now()->subMonths(6)->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->take(15)->get() : null;
                        $companiesUsers    = $companiesUsers !== null ? $companiesUsers->where('raffles.created_at', '>', Carbon::now()->subMonths(6)->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->take(15)->get() : null;

                        $title = "Ultimos 6 meses";

                        break;

                    case "3": /* Anual */

                        $registeredRaffles = $registeredRaffles->where('raffles.created_at', '>', Carbon::now()->startOfYear()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->get();
                        $registeredTickets = $registeredTickets->where('orderable_date', '>', Carbon::now()->startOfYear()->toDateString())->where('orderable_date', '<', Carbon::now()->endOfMonth()->toDateString())->pluck('orderable_date');
                        $movements         = $movements !== null ? $movements->where('raffles.created_at', '>', Carbon::now()->startOfYear()->toDateString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateString())->take(15)->get() : null;
                        $companiesUsers    = $companiesUsers !== null ? $companiesUsers->where('raffles.created_at', '>', Carbon::now()->startOfYear()->toDateString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateString())->take(15)->get() : null;

                        $title = "Ultimo año";

                        break;

                    case "4": /* Total */

                        $registeredRaffles = $registeredRaffles->get();
                        $registeredTickets = $registeredTickets->pluck('orderable_date');
                        $movements         = $movements !== null ? $movements->take(15)->get() : null;
                        $companiesUsers    = $companiesUsers !== null ? $companiesUsers->take(15)->get() : null;

                        $title = "Total";

                        break;
                }

            } else{
                $registeredRaffles = $registeredRaffles->where('raffles.created_at', '>', Carbon::now()->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->get();
                $registeredTickets = $registeredTickets->where('orderable_date', '>', Carbon::now()->startOfMonth()->toDateString())->where('orderable_date', '<', Carbon::now()->endOfMonth()->toDateString())->pluck('orderable_date');

                if(Auth::user()->role_id !== 2){
                    $movements         = $movements->where('raffles.created_at', '>', Carbon::now()->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->take(15)->get();
                    $companiesUsers    = $companiesUsers->where('raffles.created_at', '>', Carbon::now()->startOfMonth()->toDateTimeString())->where('raffles.created_at', '<', Carbon::now()->endOfMonth()->toDateTimeString())->take(15)->get();    
                } else {
                    $movements      = null;
                    $companiesUsers = null;
                }
                
                $month = Carbon::now()->locale('es_ES');
                $title = ucfirst($month->monthName);
            }


            /* Se carga el array para el grafico de tickets vendidos o pendientes */
            $requested = 0; $paid = 0;
            foreach($registeredTickets as $index => $date){

                $ticketsTransactions[$index]['orderable_date'] = $date;

                foreach($listTransactions as $i => $detail){

                    /* Se verifica que las fechas coincidan y asigna el conteo segun el tipo de registro sea (registrado o pagado) */
                    if($detail->orderable_date == $date){
                        $requested  = $detail->paid == 0 ? $detail->count : $requested;
                        $paid       = $detail->paid == 1 ? $detail->count : $paid;
                    }
                }

                $ticketsTransactions[$index]['requested']   = $requested;
                $ticketsTransactions[$index]['paid']        = $paid;
            }

            return view('panel.index', compact('registeredRaffles', 'title', 'ticketsTransactions', 'movements', 'companiesUsers', 'filter'));

        } catch(\Throwable $e){
            Log::error('PanelController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "");
        }
    }
}

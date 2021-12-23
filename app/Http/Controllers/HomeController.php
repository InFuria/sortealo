<?php

namespace App\Http\Controllers;

use App\Raffle;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* $this->middleware('auth'); */
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{

            $raffles = Raffle::with(['clients', 'category', 'files', 'company'])->withCount(['clients']);

            $options = request()->filter;

            if(isset($options)){
                
                switch($options){

                    case 'mas_comprados':

                        // Se trae solo el conteo de los tickets con estado de pagado
                        $raffles = $raffles->where('status', 1)->orderBy('clients_count', 'DESC')->whereHas('clients', function (Builder $query) {
                            $query->where('paid', 1);
                        })->take(30)->paginate(15);

                        break;

                    case 'terminando':

                        
                        $raffles = $raffles->where('status', 1)->where('end_date', '<', Carbon::now()->addDays(7)->startOfDay()->toDateTimeString())->where('end_date', '>', Carbon::now()->startOfDay()->toDateTimeString())->orderBy('end_date', 'ASC')->paginate(15);

                        break;

                    /* case 'finalizados':
                        
                        $raffles = Raffle::where('status', 3)->with(['category', 'files', 'company'])->orderBy('updated_at', 'DESC')->withCount(['clients'])->paginate(15);
                        
                        break; */

                    case 'mayor_costo':
                    
                        $raffles = $raffles->where('status', 1)->orderBy('cost_per_ticket', 'DESC')->paginate(15);

                        break;

                    case 'menor_costo':
                    
                        $raffles = $raffles->where('status', 1)->orderBy('cost_per_ticket', 'ASC')->paginate(15);

                        break;

                    default:

                        $raffles = Raffle::where('status', 1)->with(['category', 'files', 'company'])->orderBy('updated_at', 'DESC')->withCount(['clients'])->paginate(15);

                        break;
                }

                return view('index', compact('raffles'));
            }

            $raffles = Raffle::where('status', 1)->with(['category', 'files', 'company'])->orderBy('updated_at', 'DESC')->withCount(['clients'])->paginate(15);

            return view('index', compact('raffles'));

        } catch(\Throwable $e){
            Log::error('HomeController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }
}

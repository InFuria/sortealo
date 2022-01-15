<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RaffleRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Raffle;
use App\Company;
use App\File;
use App\RaffleCategory;
use App\RaffleClient;
use Carbon\Carbon;

class RaffleController extends Controller
{

    public function index()
    {
        try{

            $user = Auth()->user();
            if($user->role_id == 2){

                if(!isset($user->company)){
                    return redirect()->back()->with('toast_success', 'Esta cuenta no tiene una empresa asociada');
                }

                if(request()->ajax()){
                    $raffles = Raffle::where('title',  'LIKE','%'. request()->search .'%')->orWhere('description', 'LIKE','%'. request()->search .'%')->orWhereHas('category', function($q){
                        $q->where('name', 'LIKE','%'. request()->search .'%');
                    })
                    ->where('company_id', $user->company->id)->orderBy('updated_at', 'DESC')->with(['category', 'files', 'company', 'creator'])->withCount(['clients'])->paginate(15);
    
                    return response()->json($raffles);
                }
    
                /* Esta busqueda se usa para ubicar de forma rapida el sorteo desde otra vista */
                if(request()->search){
                    $raffles = Raffle::where('title',  'LIKE','%'. request()->search .'%')->orWhere('description', 'LIKE','%'. request()->search .'%')->orWhereHas('category', function($q){
                        $q->where('name', 'LIKE','%'. request()->search .'%');
                    })
                    ->where('company_id', $user->company->id)->orderBy('updated_at', 'DESC')->with(['category', 'files', 'company', 'creator'])->withCount(['clients'])->paginate(10);
    
                    return view('raffles.index', compact('raffles'));
                }
    
                $raffles = Raffle::orderBy('updated_at', 'DESC')->where('company_id', $user->company->id)->with(['category', 'files', 'company', 'creator'])->withCount(['clients'])->paginate(15);
    
                return view('raffles.index', compact('raffles'));

            }

            if(request()->ajax()){
                $raffles = Raffle::where('title',  'LIKE','%'. request()->search .'%')->orWhere('description', 'LIKE','%'. request()->search .'%')->orWhereHas('category', function($q){
                    $q->where('name', 'LIKE','%'. request()->search .'%');
                })
                ->orderBy('updated_at', 'DESC')->with(['category', 'files', 'company', 'creator'])->withCount(['clients'])->paginate(15);

                return response()->json($raffles);
            }

            /* Esta busqueda se usa para ubicar de forma rapida el sorteo desde otra vista */
            if(request()->search){
                $raffles = Raffle::where('title',  'LIKE','%'. request()->search .'%')->orWhere('description', 'LIKE','%'. request()->search .'%')->orWhereHas('category', function($q){
                    $q->where('name', 'LIKE','%'. request()->search .'%');
                })
                ->orderBy('updated_at', 'DESC')->with(['category', 'files', 'company', 'creator'])->withCount(['clients'])->paginate(10);

                return view('raffles.index', compact('raffles'));
            }

            $raffles = Raffle::orderBy('updated_at', 'DESC')->with(['category', 'files', 'company', 'creator'])->withCount(['clients'])->paginate(15);

            return view('raffles.index', compact('raffles'));

        } catch(\Throwable $e){
            Log::error('RaffleController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function create()
    {
        try{
            
            $categories = RaffleCategory::pluck('name', 'id');
            $companies = Company::pluck('name', 'id');

            return view('raffles.create', compact('categories', 'companies'));

        } catch(\Throwable $e){
            Log::error('RaffleController::create - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function store(RaffleRequest $request)
    {
        try{

            if($request->multiple_winners == 1 && $request->extra_winners <= 0){
                return redirect()->back()->with('toast_error', 'Debe seleccionar una cantidad de ganadores si selecciona la opcion "Multiples ganadores"');
            }

            if($request->raffle_date == "0000/00/00 00:00:00"){
                return redirect()->back()->with('toast_error', 'Debe definir una fecha de sorteo');
            }

            $start_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_date)->format('Y-m-d H:i:s');
            $end_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_date)->format('Y-m-d H:i:s');
            $raffle_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->raffle_date)->format('Y-m-d H:i:s');

            $company = null;
            if(Auth()->user->role_id == 2){
                $company = Auth::user()->company_id;

            } else if(Auth::user()->role_id !== 2 && $request->company_id){
                $company = $request->company_id;

            } else {
                
                return redirect()->back()->with('toast_error', 'No se ha podido encontrar una empresa asociada al usuario o no selecciono la empresa a ;a cual pertenece el sorteo.');
            }

            $raffle = new Raffle();
            $raffle->title              = $request->title;
            $raffle->quantity_tickets   = $request->quantity_tickets;
            $raffle->cost_per_ticket    = $request->cost_per_ticket;
            $raffle->description        = $request->description;
            $raffle->type_id            = null;
            $raffle->category_id        = $request->category_id;
            $raffle->status             = $request->status;
            $raffle->multiple_winners   = $request->multiple_winners;
            $raffle->extra_winners      = $request->extra_winners;
            $raffle->start_date         = $start_date;
            $raffle->end_date           = $end_date;
            $raffle->raffle_date        = $raffle_date;
            $raffle->company_id         = $company;
            $raffle->created_by         = Auth::user()->id;
            $raffle->save();

            $images = $request->images;
            if(isset($images))
            foreach($images as $image){
                if($image->isValid()){
                    
                    $savedFile = Storage::putFile('public/raffles/', $image);
                    $storageName = basename($savedFile);

                    $file = new File();
                    $file->name = $storageName;
                    $file->raffle_id = $raffle->id;
                    $file->save();
                }
            }

            return redirect()->to('raffles')->with("toast_success", "");

        } catch(\Throwable $e){
            Log::error('RaffleController::store - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al crear el sorteo");
        }
    }


    public function show(Raffle $raffle)
    {
        try{
            
            return view('raffles.show');

        } catch(\Throwable $e){
            Log::error('RaffleController::show - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function edit(Raffle $raffle)
    {
        try{

            $categories = RaffleCategory::pluck('name', 'id');
            $companies = Company::pluck('name', 'id');
            
            return view('raffles.edit', compact('raffle', 'categories', 'companies'));

        } catch(\Throwable $e){
            Log::error('RaffleController::edit - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function update(RaffleRequest $request, Raffle $raffle)
    {
        try{
            
            if($request->multiple_winners == 1 && $request->extra_winners <= 0){
                return redirect()->back()->with('toast_error', 'Debe seleccionar una cantidad de ganadores si selecciona la opcion "Multiples ganadores"');
            }

            if($request->raffle_date == "0000/00/00 00:00:00"){
                return redirect()->back()->with('toast_error', 'Debe definir una fecha de sorteo');
            }

            $company = null;
            if(Auth::user()->role_id == 2){
                $company = Auth::user()->company_id;

            } else if(Auth::user()->role_id !== 2 && $request->company_id){
                $company = $request->company_id;

            } else {
                
                return redirect()->back()->with('toast_error', 'No se ha podido encontrar una empresa asociada al usuario o no selecciono la empresa a ;a cual pertenece el sorteo.');
            }

            $start_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_date)->format('Y-m-d H:i:s');
            $end_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end_date)->format('Y-m-d H:i:s');
            $raffle_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->raffle_date)->format('Y-m-d H:i:s');

            $raffle->title              = $request->title;
            $raffle->quantity_tickets   = $request->quantity_tickets;
            $raffle->cost_per_ticket    = $request->cost_per_ticket;
            $raffle->description        = $request->description;
            $raffle->type_id            = null;
            $raffle->category_id        = $request->category_id;
            $raffle->status             = $request->status;
            $raffle->multiple_winners   = $request->multiple_winners;
            $raffle->extra_winners      = $request->extra_winners;
            $raffle->start_date         = $start_date;
            $raffle->end_date           = $end_date;
            $raffle->raffle_date        = $raffle_date;
            $raffle->company_id         = $company;
            $raffle->save();

            $images = $request->images;
            if(isset($images))
            foreach($images as $image){
                if($image->isValid()){
                    
                    $savedFile = Storage::putFile('public/raffles/', $image);
                    $storageName = basename($savedFile);

                    $file = new File();
                    $file->name = $storageName;
                    $file->raffle_id = $raffle->id;
                    $file->save();
                }
            }

            return redirect()->to('raffles')->with("toast_success", "Se ha actualizado el sorteo!");

        } catch(\Throwable $e){
            Log::error('RaffleController::update - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al actualizar el sorteo");
        }
    }

    public function removeImage(Request $request, File $file)
    {
        try{
            $raffle = $file->raffle;

            $deleted = Storage::delete('public/raffles/'.$file->name);
            
            if($deleted == true)
                $file->delete();
            

            return redirect()->to('raffles/' . $raffle->id . '/edit')->with("toast_success", "Se ha eliminado la imagen!");

        } catch(\Throwable $e){
            Log::error('RaffleController::removeImage - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al eliminar la imagen");
        }
    }


    /* Controllers para vistas publicas */

    public function detail(Raffle $raffle)
    {
        try{

            $count      = Raffle::where('id', $raffle->id)->withCount('clients')->first();
            $winners    = RaffleClient::where('status', 1)->where('paid', 1)->where('raffle_id', $raffle->id)->get();

            $raffle->remaining = $raffle->quantity_tickets - $count->clients_count;

            return view('raffles.detail', compact('raffle', 'winners'));

        } catch(\Throwable $e){
            Log::error('RaffleController::detail - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function results()
    {
        try{

            $raffles = Raffle::where('status', 3)->with(['category', 'files', 'company'])->orderBy('updated_at', 'DESC')->withCount(['clients'])->paginate(1);

            return view('raffles.results', compact('raffles'));

        } catch(\Throwable $e){
            Log::error('RaffleController::results - ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }
}

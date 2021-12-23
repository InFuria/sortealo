<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        try{
            
            return view('layouts.contact');

        } catch(\Throwable $e){
            Log::error('ContactController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }

    public function send()
    {
        try{
            
            

        } catch(\Throwable $e){
            Log::error('ContactController::send - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al procesar los datos");
        }
    }
}

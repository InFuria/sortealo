<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

    public function send(Request $request)
    {
        try{

            Mail::send([], [], function ($message) use($request){
                $message->from("$request->email")
                ->to("sortealo@sortealo.buddycharming.com")
                ->subject($request->reason)
                ->setBody("<html><p>$request->message</p><br/><p>Telefono de contacto: $request->phone</p></html>", 'text/html');
            });  

            return redirect()->back()->with('toast_success', 'Se ha enviado el correo!');

        } catch(\Throwable $e){
            Log::error('ContactController::send - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al procesar los datos");
        }
    }
}

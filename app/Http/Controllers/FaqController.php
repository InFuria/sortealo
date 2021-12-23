<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use App\FaqCategory;
use App\Http\Requests\FaqRequest;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    public function index($search = null)
    {
        try{

            if(request()->categoria){
                $faqs = FaqCategory::where('name', request()->categoria)->with(['faqs'])->orderBy('id', 'ASC')->first();

                return view('faqs.index', compact('faqs'));
            }

            $categories = FaqCategory::with(['faqs'])->orderBy('id', 'ASC')->get();

            return view('faqs.index', compact('categories'));

        } catch(\Throwable $e){
            Log::error('FaqController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }

    public function manage()
    {
        try{

            if(request()->ajax()){
                $faqs = Faq::where('question',  'LIKE','%'. request()->search .'%')->orWhere('answer', 'LIKE','%'. request()->search .'%')->with(['category'])->orderBy('updated_at', 'DESC')->paginate(15);

                return response()->json($faqs);
            }

            /* Esta busqueda se usa para ubicar de forma rapida la pregunta desde otra vista */
            if(request()->search){
                $faqs = Faq::where('question',  'LIKE','%'. request()->search .'%')->orWhere('answer', 'LIKE','%'. request()->search .'%')->with(['category'])->orderBy('updated_at', 'DESC')->paginate(10);

                return view('faqs.manage', compact('faqs'));
            }

            $faqs = Faq::with(['category'])->orderBy('updated_at', 'DESC')->paginate(15);

            return view('faqs.manage', compact('faqs'));

        } catch(\Throwable $e){
            Log::error('FaqController::manage - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }

    public function create()
    {
        try{

            $categories = FaqCategory::pluck('name', 'id');

            return view('faqs.create', compact('categories'));

        } catch(\Throwable $e){
            Log::error('FaqController::create - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function store(FaqRequest $request)
    {
        try{
            $faq = new Faq();
            $faq->question      = $request->question;
            $faq->answer        = $request->answer;
            $faq->category_id   = $request->category_id;
            $faq->save();

            return redirect()->to('faqs/manage')->with("toast_success", "Se ha creado una nueva pregunta!");

        } catch(\Throwable $e){
            Log::error('FaqController::store - ' . $e->getMessage());
            return redirect()->back()->withToastError('Ha ocurrido un error al crear la pregunta');
        }
    }


    public function edit(Faq $faq)
    {
        try{
            
            $categories = FaqCategory::pluck('name', 'id');

            return view('faqs.edit', compact('faq', 'categories'));

        } catch(\Throwable $e){
            Log::error('FaqController::edit - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function update(FaqRequest $request, Faq $faq)
    {
        try{

            $faq->question      = $request->question;
            $faq->answer        = $request->answer;
            $faq->category_id   = $request->category_id;
            $faq->save();

            return redirect()->to('faqs/manage')->with("toast_success", "Se ha actualizado la pregunta!");

        } catch(\Throwable $e){
            Log::error('FaqController::update - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al actualizar la pregunta");
        }
    }


    public function destroy(Faq $faq)
    {
        try{

            $faq->delete();

            return redirect()->to('faqs/manage')->with('toast_success', 'Se ha eliminado la pregunta!');

        } catch(\Throwable $e){
            Log::error('FaqController::destroy - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al eliminar la pregunta");
        }
    }
}

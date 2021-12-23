<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Company;
use App\File;


class CompanyController extends Controller
{

    public function index()
    {
        try{
            if(request()->ajax()){
                $companies = Company::where('name',  'LIKE','%'. request()->search .'%')->orWhere('email', 'LIKE','%'. request()->search .'%')->with(['users'])->orderBy('updated_at', 'DESC')->paginate(15);

                return response()->json($companies);
            }

            /* Esta busqueda se usa para ubicar de forma rapida la empresa */
            if(request()->search){
                $companies = Company::where('name',  'LIKE','%'. request()->search .'%')->orWhere('email', 'LIKE','%'. request()->search .'%')->with(['users'])->orderBy('updated_at', 'DESC')->paginate(10);

                return view('companies.index', compact('companies'));
            }

            $companies = Company::orderBy('updated_at', 'DESC')->with(['users'])->paginate(15);
            
            return view('companies.index', compact('companies'));

        } catch(\Throwable $e){
            Log::error('CompanyController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function create()
    {
        try{

            return view('companies.create');

        } catch(\Throwable $e){
            Log::error('CompanyController::create - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function store(CompanyRequest $request)
    {
        try{
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $company->webpage = $request->webpage;
            $company->status = 1;

            if ($request->hasFile('photo')) {

                $photo = $request->photo;
                if ($photo->isValid()) {

                    $savedFile = Storage::putFile('public/companies/', $photo);
                    $storageName = basename($savedFile);

                    $company->photo = $storageName;

                } else {
                    $company->photo = null;
                }

            } else {
                $company->photo = null;
            }

            $company->save();

            return redirect()->to('companies')->with("toast_success", "Se ha creado una nueva empresa!");

        } catch(\Throwable $e){
            Log::error('CompanyController::store - ' . $e->getMessage());
            return redirect()->back()->withToastError('Ha ocurrido un error al crear la empresa' );
        }
    }

    public function show(Company $company)
    {
        try{

            $users = $company->users()->paginate(6);
            $company = $company->where('id', $company->id)->withCount(['users'])->first();

            return view('companies.show', compact('company', 'users'));

        } catch(\Throwable $e){
            Log::error('CompanyController::show - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function edit(Company $company)
    {
        try{

            return view('companies.edit', compact('company'));

        } catch(\Throwable $e){
            Log::error('CompanyController::edit - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function update(Request $request, Company $company)
    {
        try{

            $validated = $request->validate([
                "name"      => "required|string|max:255",
                "email"     => "required|string",
                "phone"     => "required|string",
                "address"   => "nullable|string",
                "webpage"   => "nullable|string",
                'photo'     => 'nullable|image'
            ]);
            
            $company->name = $validated['name'];
            $company->email = $validated['email'];
            $company->phone = $validated['phone'];
            $company->address = $validated['address'];
            $company->webpage = $validated['webpage'];
            $company->status = isset($validated['status']) ? $validated['status'] : $company->status;
            $company->save();

            if ($request->hasFile('photo')) {

                $old = $company->photo;
                $file = $request->photo;

                if ($file->isValid()) {
                    
                    $savedFile = Storage::putFile('public/companies/', $file);
                    $storageName = basename($savedFile);

                    $company->photo = $storageName;
                    $company->save();

                    if(isset($old))
                        Storage::delete('public/companies/', $old);

                } else {
                    $company->photo = isset($company->photo) ? $company->photo : null;
                    $company->save();
                }

            } else {
                $company->photo = isset($company->photo) ? $company->photo : null;
                $company->save();
            }

            return redirect()->to('companies')->with("toast_success", "Se ha actualizado la empresa!");

        } catch(\Throwable $e){
            Log::error('CompanyController::update - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al actualizar la empresa");
        }
    }


    public function destroy(Company $company)
    {
        try{
            
            return redirect()->to('companies')->with('toast_success', 'Se ha eliminado la empresa!');

        } catch(\Throwable $e){
            Log::error('CompanyController::destroy - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al eliminar la empresa");
        }
    }

    public function status(Company $company)
    {
        try{

            $company->status = !$company->status;
            $company->save();
            
            return redirect()->to('companies')->with('toast_success', 'Se ha actualizado el estado de la empresa!');

        } catch(\Throwable $e){
            Log::error('CompanyController::status - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al actualizar el estado de la empresa");
        }
    }
}

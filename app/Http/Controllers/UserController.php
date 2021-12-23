<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Company;
use App\User;
use App\Role;
use App\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        try{
            
            if(request()->ajax()){
                $users = User::where('username',  'LIKE','%'. request()->search .'%')->orWhere('email', 'LIKE','%'. request()->search .'%')->with(['company', 'role'])->orderBy('updated_at', 'DESC')->paginate(15);

                return response()->json($users);
            }

            /* Esta busqueda se usa para ubicar de forma rapida al usuario desde otra vista */
            if(request()->search){
                $users = User::where('username',  'LIKE','%'. request()->search .'%')->orWhere('email', 'LIKE','%'. request()->search .'%')->with(['company', 'role'])->orderBy('updated_at', 'DESC')->paginate(10);

                return view('users.index', compact('users'));
            }

            $users = User::orderBy('updated_at', 'DESC')->with(['company', 'role'])->paginate(15);
            
            return view('users.index', compact('users'));

        } catch(\Throwable $e){
            Log::error('UserController::index - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function create()
    {
        try{

            $roles = Role::pluck('name', 'id');
            $companies = Company::pluck('name', 'id');

            return view('users.create', compact('roles', 'companies'));

        } catch(\Throwable $e){
            Log::error('UserController::create - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function store(UserRequest $request)
    {
        try{
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->role_id = $request->role_id;
            $user->company_id = $request->company_id;
            $user->status = 1;

            if ($request->hasFile('photo')) {

                $file = $request->photo;
                if ($file->isValid()) {
                    
                    $savedFile = Storage::putFile('public/users/', $file);
                    $storageName = basename($savedFile);

                    $user->photo = $storageName;

                } else {
                    $user->photo = null;
                }

            } else {
                $user->photo = null;
            }

            $user->save();

            return redirect()->to('users')->with("toast_success", "Se ha creado un nuevo usuario!");

        } catch(\Throwable $e){
            Log::error('UserController::store - ' . $e->getMessage());
            return redirect()->back()->withToastError('Ha ocurrido un error al crear al usuario' );
        }
    }


    public function edit(User $user)
    {
        try{
            
            $roles = Role::pluck('name', 'id');
            $companies = Company::pluck('name', 'id');

            return view('users.edit', compact('user', 'roles', 'companies'));

        } catch(\Throwable $e){
            Log::error('UserController::edit - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }


    public function update(Request $request, User $user)
    {
        try{

            $validated = $request->validate([
                'name'          => 'required|string',
                'username'      => 'required|string',
                'email'         => 'required',
                'phone'         => 'required|string',
                'password'      => 'nullable|string',
                'role_id'       => 'required|numeric',
                'company_id'    => 'nullable|numeric|exists:companies,id',
                'photo'         => 'nullable|image'
            ]);
            
            $user->name = $validated['name'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            $user->password = isset($validated['password']) ? Hash::make($validated['password']) : $user->password;
            $user->phone = $validated['phone'];
            $user->role_id = $validated['role_id'];
            $user->company_id = $validated['company_id'];
            $user->save();

            if ($request->hasFile('photo')) {

                $old = $user->photo;
                $file = $request->photo;

                if ($file->isValid()) {
                    
                    $savedFile = Storage::putFile('public/users/', $file);
                    $storageName = basename($savedFile);

                    $user->photo = $storageName;
                    $user->save();

                    if(isset($old))
                        Storage::delete('public/users/', $old);

                } else {
                    $user->photo = isset($user->photo) ? $user->photo : null;
                    $user->save();
                }

            } else {
                $user->photo = isset($user->photo) ? $user->photo : null;
                $user->save();
            }

            return redirect()->to('users')->with("toast_success", "Se ha actualizado al usuario!");

        } catch(\Throwable $e){
            Log::error('UserController::update - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al actualizar al usuario");
        }
    }


    public function destroy($id)
    {
        try{
            
            return redirect()->to('users')->with('toast_success', 'Se ha eliminado al usuario!');

        } catch(\Throwable $e){
            Log::error('UserController::destroy - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al eliminar al usuario");
        }
    }

    public function status(User $user)
    {
        try{

            $user->status = !$user->status;
            $user->save();
            
            return redirect()->to('users')->with('toast_success', 'Se ha actualizado el estado del usuario!');

        } catch(\Throwable $e){
            Log::error('UserController::status - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al actualizar el estado del usuario");
        }
    }

    public function profile(User $user)
    {
        try{
            $roles = Role::pluck('name', 'id');
            $companies = Company::pluck('name', 'id');

            return view('users.profile', compact('user', 'roles', 'companies'));

        } catch(\Throwable $e){
            Log::error('UserController::profike - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }

    public function updateProfile(Request $request, User $user)
    {
        try{
            
            $validated = $request->validate([
                'name'          => 'required|string',
                'username'      => 'required|string',
                'email'         => 'required',
                'phone'         => 'required|string',
                'password'      => 'nullable|string',
                'photo'         => 'nullable|image'
            ]);
            
            $user->name = $validated['name'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            $user->password = isset($validated['password']) ? Hash::make($validated['password']) : $user->password;
            $user->phone = $validated['phone'];
            $user->role_id = $user->role_id;
            $user->company_id = $user->company_id;
            $user->save();

            if ($request->hasFile('photo')) {

                $old = $user->photo;
                $file = $request->photo;

                if ($file->isValid()) {
                    
                    $savedFile = Storage::putFile('public/users/', $file);
                    $storageName = basename($savedFile);

                    $user->photo = $storageName;
                    $user->save();

                    if(isset($old))
                        Storage::delete('public/users/', $old);

                } else {
                    $user->photo = isset($user->photo) ? $user->photo : null;
                    $user->save();
                }

            } else {
                $user->photo = isset($user->photo) ? $user->photo : null;
                $user->save();
            }

            return redirect()->back()->with("toast_success", "Se han actualizado sus datos!");

        } catch(\Throwable $e){
            Log::error('UserController::profike - ' . $e->getMessage());
            return redirect()->back()->with("toast_error", "Ha ocurrido un error al cargar la pagina");
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
      $this->middleware(['role:Admin']);
    }
 
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'user' => 'required',
            'roles' => 'required',
        ]);

        
        try {
            DB::transaction(function () use ($request) {
                $input = array();
                $input['name'] = $request->name;
                $input['username'] = $request->user;
                $input['email'] = $request->email;
                $input['password'] = bcrypt("123");
        
                $user = User::create($input);

                   // Obtén el nombre del rol usando el ID proporcionado en la solicitud
                $role = Role::findById($request->roles)->name; 

                $user->assignRole($role);
            });

            return redirect()->route('entradas')->with('success', "Registro creado correctamente!!");
        } catch (\Exception $ex) {
            Log::channel('user')->error($ex->getMessage());
            //Log::error($ex);
           // return redirect()->back()->with("error", "Error al guardar el registro de usuario.");
           return redirect()->back()->withInput()->with(['error' => 'Error al guardar el registro de usuario.']);

           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

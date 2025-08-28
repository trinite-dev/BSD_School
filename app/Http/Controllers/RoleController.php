<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Role $role)
    {
         //vérification de permission
         //$this->authorize('viewAny', $role);
         //$role->create($this->params($request));
         
         //On récupère tous les role
        $role = Role::all();

        // On retourne les informations des role en JSON
        return response()->json($role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //vérification de permission  
         //$this->authorize('create', $role);
         //$role->create($this->params($request));
 
         // La validation de données
         $this->validate($request, [
             'name' => 'required|max:100',
         ]);
 
         // On crée un nouvel role
         $role = Role::create([
             'name' => $request->name,
         ]);
 
         // On retourne les informations du nouvel role en JSON
         return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role, $id)
    {
         //vérification de permission 
         //$this->authorize('view', $role);
         //$role->view($this->params($request));
         $role = Role::findOrFail($id);
        // On retourne les informations de l'utilisateur en JSON
        return response()->json($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, Role $role)
    {
        
        //vérification de permission  
        $this->authorize('update', $role);

        
        // La validation de données
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        // On modifie les informations de role
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        // On retourne la réponse JSON
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json("succes");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Group $group)
    {
        //vérification de permission
        $this->authorize('viewAny', $group);
        
        //On récupère tous les groupes
       $group = Group::all();

       // On retourne les informations des groupes en JSON
       return response()->json($group);
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
    public function store(Request $request, Group $group)
    {
          //vérification de permission  
          $this->authorize('create', $group);
  
          // La validation de données
          $this->validate($request, [
              'name' => 'required|max:100',
          ]);
  
          // On crée un nouvel groupe
          $group = Group::create([
              'name' => $request->name,
          ]);
  
          // On retourne les informations du nouvel groupe en JSON
          return response()->json($group, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group,$id)
    {
         //vérification de permission 
         //$this->authorize('view', $group);
         $group = Group::findOrFail($id);
        // On retourne les informations du groupe en JSON
        return response()->json($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, $id)
    {
         //vérification de permission  
         //$this->authorize('update', $group);
         //$group->update($this->params($request));
 
            
        // La validation de données
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        // On modifie les informations de role
        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->save();
        // On retourne la réponse JSON
        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group,$id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return response()->json("succes");
    }
}

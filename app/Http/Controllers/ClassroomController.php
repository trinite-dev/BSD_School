<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Classroom $classroom)
    {
        //vérification de permission
        $this->authorize('viewAny', $classroom);
        
        //On récupère tous les classe
       $classroom = Classroom::all();

       // On retourne les informations des classes en JSON
       return response()->json($classroom);
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
     * 
     *  @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request,Classroom $classroom)
    {
         //vérification de permission  
          $this->authorize('create', $classroom);
  
          // La validation de données
          $this->validate($request, [
            'name' => 'required|max:100',
            'group_id' => 'required|integer|min:1',
            'kitbsd_id' => 'integer|min:1',
        ]);

        // On crée une nouvelle classe
        $classroom = Classroom::create([
            'name' => $request->name,
            'group_id' => $request->group_id,
            'kitbsd_id' => $request->kitbsd_id,
        ]);

        // On retourne les informations de la nouvelle classe en JSON
        return response()->json($classroom, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom,$id)
    {
        //vérification de permission 
         $this->authorize('view', $classroom);
         $classroom = Classroom::findOrFail($id);
        // On retourne les informations du groupe en JSON
        return response()->json($classroom);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom,$id)
    {
          //vérification de permission  
         $this->authorize('update', $classroom);
        
 
            
        // La validation de données
        $this->validate($request, [
            'name' => 'required|max:100',
            'group_id' => 'required|integer|min:1',
            'kitbsd_id' => 'integer|min:1',
        ]);

        // On modifie les informations de role
        $classroom = Classroom::findOrFail($id);
        $classroom->name = $request->name;
        $classroom->group_id = $request->group_id;
        $classroom->kitbsd_id = $request->kitbsd_id;
        $classroom->save();
        // On retourne la réponse JSON
        return response()->json($classroom);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom,$id)
    {
        $this->authorize('delete', $classroom);
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();
        return response()->json("succes");
    }
}

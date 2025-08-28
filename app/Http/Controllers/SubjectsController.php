<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Subjects $subjects)
    {
         //vérification de permission
         //$this->authorize('viewAny', $subjects);
         //$subjects->create($this->params($request));
         
         //On récupère tous les utilisateurs
        $subjects = Subjects::all();

        // On retourne les informations des matiere en JSON
        return response()->json($subjects);
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
    public function store(Request $request, Subjects $subjects)
    {
         //vérification de permission  
         //$this->authorize('create', $subjects);
         //$subjects->create($this->params($request));
 
         // La validation de données
         $this->validate($request, [
             'name' => 'required|max:100',
         ]);
 
         // On crée un nouvelle matiere
         $subjects = Subjects::create([
             'name' => $request->name,
         ]);
 
         // On retourne les informations du nouvelle matiere en JSON
         return response()->json($subjects, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects $subjects,$id)
    {
        
         //vérification de permission 
         $this->authorize('view', $subjects);

         $subjects = Subjects::findOrFail($id);
        // On retourne les informations de la matiere en JSON
        return response()->json($subjects);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, Subjects $subjects)
    {
         //vérification de permission  
         //$this->authorize('update', $subjects);
         //$subjects->update($this->params($request));
 
         // La validation de données
         $this->validate($request, [
             'name' => 'required|max:100',
         ]);
 
         // On crée un nouvelle matiere
         
        $subjects = Subjects::findOrFail($id);
        $subjects->name = $request->name;
        $subjects->save();
         // On retourne les informations du nouvelle matiere en JSON
         return response()->json($subjects, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subjects,$id)
    {
        //vérification de permission  
        //$this->authorize('delecte', $subjects);
        //$subjects->delecte($this->params($request));
        $subjects = Subjects::findOrFail($id);
        $subjects->delete();
       // On retourne la réponse JSON
       return response()->json("succes");
    }

    private function params(){
        return $request->all();
    }
}

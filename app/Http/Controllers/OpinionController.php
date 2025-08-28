<?php

namespace App\Http\Controllers;

use App\Models\Kitbsd;
use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Opinion $opinion)
    {
        //vérification de permission
        $this->authorize('viewAny', $opinion);
        
        //On récupère tous les opinions
       $opinion = Opinion::all();

       // On retourne les informations des opinions en JSON
       return response()->json($opinion);
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
    public function store(Request $request, Kitbsd $kitbds)
    {
        //vérification de permission
        $this->authorize('create', $opinion);
         
            $this->validate($request, [
                'type' => 'required|min:1|max:9',
                'student_id' => 'required|min:1',
                'presences_id' => 'required|min:1',
            ]);
            
            $nbr= Opinion::where('student_id', '=', $request->student_id)
            ->where('presences_id', '=', $request->presences_id)
            ->count('*');

           
            if(!$nbr!=0){
                
                $opinion=Opinion::create($request->all());
            
                // On retourne la réponse JSON
                return response()->json($opinion);
            }else
            return response()->json("erreur");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function show(Opinion $opinion,$id)
    {
          //vérification de permission 
         $this->authorize('view', $opinion);
         $opinion = Opinion::findOrFail($id);
        // On retourne les informations de l'opinion en JSON
        return response()->json($opinion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function edit(Opinion $opinion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opinion $opinion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opinion $opinion,$id)
    {
        $opinion = Opinion::findOrFail($id);
        $opinion->delete();
        return response()->json("succes");
    }
}

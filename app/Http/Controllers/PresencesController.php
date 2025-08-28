<?php

namespace App\Http\Controllers;

use App\Models\Presences;
use Illuminate\Http\Request;
use App\Models\ProgrammeUser;

class PresencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Presences $presences)
    {
         //vérification de permission
         $this->authorize('viewAny', $presences);
         
         //On récupère tous les programmes
        $presences = Presences::all();

        // On retourne les informations des programmes en JSON
        return response()->json($presences);
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
        $this->authorize('create', $presences);

        $this->validate($request, [
            'subjects_id'=> 'required|min:1',
            'users_id'=> 'required|min:1',
            'classroom_id'=> 'required|min:1',
            'startat'=> 'required|date',
        ]);
        
        $nbr= ProgrammeUser::join('users', 'users.id', '=', 'programme_user.users_id')
                        ->join('programme', 'programme.id', '=', 'programme_user.programme_id')
                        ->join('classroom', 'classroom.id', '=', 'programme.classroom_id')
                        ->join('subjects', 'subjects.id', '=', 'users.subjects_id')
                        ->where('programme.classroom_id', '=', $request->classroom_id)
                        ->where('programme_user.users_id', '=', $request->users_id)
                        ->count('*');

       
        if($nbr>=1){
            
            $presences=Presences::create($request->all());
        
            // On retourne la réponse JSON
            return response()->json($presences);
        }else
        return response()->json("erreur");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presences  $presences
     * @return \Illuminate\Http\Response
     */
    public function show(Presences $presences,$id)
    {
         //vérification de permission 
         $this->authorize('view', $presences);

         $presences = Presences::findOrFail($id);
        // On retourne les informations de la presence en JSON
        return response()->json($presences);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presences  $presences
     * @return \Illuminate\Http\Response
     */
    public function edit(Presences $presences)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presences  $presences
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presences $presences)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presences  $presences
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presences $presences,$id)
    {
        //vérification de permission 
        $this->authorize('view', $presences);

        $presences = Presences::findOrFail($id);
        $presences->delete();
        return response()->json("succes");
    }
}

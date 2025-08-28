<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Models\ProgrammeUser;

class ProgrammeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProgrammeUser $programme_users)
    {
         //vérification de permission
         $this->authorize('viewAny', $programme_users);
         //$programme_users->create($this->params($request));
         
         //On récupère tous les emploie de temps
        $programme_users = ProgrammeUser::all();

        // On retourne les informations des emploie de temps en JSON
        return response()->json($programme_users);
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
    public function store(Request $request,ProgrammeUser $programme_users)
    {
        //vérification de permission
        $this->authorize('create', $programme_users);

        //validation des données entrées
        $this->validate($request, [
            'programme_id' => 'required|min:1',
            'users_id' => 'required|min:1'
        ]);
        //recherche de la matiere faite par le prof entré
        $subprof=User::where('id','=',$request->users_id)->select('subjects_id')->get();
                
        //recherche de la matiere qui doit etre faite dans le program entré
        $subgram=Programme::where('id','=',$request->programme_id)->select('subjects_id')->get();
        
        //verification si cet emploie est deja donné a un prof 
        $nbr= ProgrammeUser::where('programme_id', '=', $request->programme_id)
            ->count('*');

        if($subprof=$subgram && $nbr=0){
        $programme_users=ProgrammeUser::create($request->all());

        // On retourne la réponse JSON
        return response()->json($programme_users);

        } else{
        return response()->json('soit ce prof ne peut pas faire cette matiere, soit il a déja ce cours en charge');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgrammeUser  $programme_users
     * @return \Illuminate\Http\Response
     */
    public function show(ProgrammeUser $programme_users,$id)
    {
          //vérification de permission 
          //$this->authorize('view', $programme_users);
          //$programme_users->view($this->params($request));
          $programme_users = ProgrammeUser::findOrFail($id);
         // On retourne les informations de l'emploie de temps en JSON
         return response()->json($programme_users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProgrammeUser  $programme_users
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgrammeUser $programme_users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProgrammeUser  $programme_users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgrammeUser $programme_users,$id)
    {
        $this->validate($request, [
            'programme_id' => 'required|min:1',
            'users_id' => 'required|min:1'
        ]);

        $programme_users = ProgrammeUser::findOrFail($id);
        $programme_users->programme_id = $request->programme_id;
        $programme_users->users_id = $request->users_id;
        $programme_users->save();

        // On retourne la réponse JSON
        return response()->json($programme_users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProgrammeUser  $programme_users
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgrammeUser $programme_users,$id)
    {
        $programme_users = ProgrammeUser::findOrFail($id);
        $programme_users->delete();
        return response()->json("succes");
    }
}


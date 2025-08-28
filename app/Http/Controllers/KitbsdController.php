<?php

namespace App\Http\Controllers;

use App\Models\Kitbsd;
use Illuminate\Http\Request;

class KitbsdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Kitbsd $kitbsd)
    {
        //vérification de permission
        $this->authorize('viewAny', $kitbsd);
        
        //On récupère tous les kitbsd
       $kitbsd = Kitbsd::all();

       // On retourne les informations des kitbsd en JSON
       return response()->json($kitbsd);
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
    public function store(Request $request,Kitbsd $kitbsd)
    {
        //vérification de permission
        $this->authorize('create', $kitbsd);
        
        // La validation de données
         $this->validate($request, [
            'coderfid' => 'required|max:100',
        ]);

        // On crée un nouvel kitbsd
        $kitbsd = Kitbsd::create([
            'coderfid' => $request->coderfid,
        ]);

        // On retourne les informations du nouvel groupe en JSON
        return response()->json($kitbsd, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kitbsd  $kitbsd
     * @return \Illuminate\Http\Response
     */
    public function show(Kitbsd $kitbsd,$id)
    {
          //vérification de permission 
         //$this->authorize('view', $role);
         //$role->view($this->params($request));
         $kitbsd = Kitbsd::findOrFail($id);
        // On retourne les informations de l'utilisateur en JSON
        return response()->json($kitbsd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kitbsd  $kitbsd
     * @return \Illuminate\Http\Response
     */
    public function edit(Kitbsd $kitbsd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kitbsd  $kitbsd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kitbsd $kitbsd,$id)
    {
         // La validation de données
         $this->validate($request, [
            'coderfid' => 'required|max:100',
        ]);

        // On modifie les informations de kitbsd
        $kitbsd = Kitbsd::findOrFail($id);
        $kitbsd->coderfid = $request->coderfid;
        $kitbsd->save();
        // On retourne la réponse JSON
        return response()->json($kitbsd);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kitbsd  $kitbsd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kitbsd $kitbsd,$id)
    {
        $kitbsd = Kitbsd::findOrFail($id);
        $kitbsd->delete();
        return response()->json("succes");
    }
}

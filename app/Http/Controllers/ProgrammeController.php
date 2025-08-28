<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Requests\StoreProgramRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          //vérification de permission
          $this->authorize('viewAny', $programme);
          
          //On récupère tous les programmes
         $programme = Programme::all();
 
         // On retourne les informations des programmes en JSON
         return response()->json($programme);
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
            //$this->authorize('create', $student);
            //$student->create($this->params($request));
     
        $this->validate($request, [
            'day' => 'required|date_format:l',
            'hour' => 'required|date_format:"H:i"',
            'subjects_id' => 'required|min:1',
            'classroom_id' => 'required|min:1'
        ]);

        
        $programme=Programme::create($request->all());

        // On retourne la réponse JSON
        return response()->json($programme);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme,$id)
    {
         //vérification de permission 
         //$this->authorize('view', $programme);
         //$programme->view($this->params($request));
         $programme = Programme::findOrFail($id);
        // On retourne les informations de le programme en JSON
        return response()->json($programme);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Programme $programme)
    {
        $this->validate($request, [
            'day' => 'required|date_format:l',
            'hour' => 'required|date_format:"H:i"',
            'subjects_id' => 'required|min:1',
            'classroom_id' => 'required|min:1'
        ]); 

        $programme = Programme::findOrFail($id);
        $programme->day = $request->day;
        $programme->hour = $request->hour;
        $programme->subjects_id = $request->subjects_id;
        $programme->classroom_id = $request->classroom_id;
        $programme->save();

        // On retourne la réponse JSON
        return response()->json($programme);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme,$id)
    {
        $programme = Programme::findOrFail($id);
        $programme->delete();
        return response()->json("succes");

    }
}

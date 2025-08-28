<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Student $student)
    {
        //vérification de permission
         //$this->authorize('viewAny', $student);
         //$student->create($this->params($request));

        // On récupère tous les utilisateurs
        $student = Student::all();

        // On retourne les informations des utilisateurs en JSON
        return response()->json($student);
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
    public function store(Request $request, Student $student)
    {
        
        //vérification de permission  
        //$this->authorize('create', $student);
        //$student->create($this->params($request));

        $this->validate($request, [
            'name' => 'required|max:100',
            'coderfid' => 'required|min:7|unique:student',
            'users_id' => 'required|min:1',
            'classroom_id' => 'required|min:1',
        ]);

        // On creer les informations de l'eleve
        $student=Student::create([
            'name' => $request->name,
            'coderfid' => $request->coderfid,
            'users_id' => $request->users_id,
            'classroom_id' =>  $request->classroom_id,
        ]);

        // On retourne la réponse JSON
        return response()->json($student);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student,Request $request,$id)
    {
          //vérification de permission 
          //$this->authorize('view', $student);
          //$student->view($this->params($request));
          
          $student = Student::findOrFail($id);
         // On retourne les informations de l'eleve en JSON
         return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Student $student)
    {
        //vérification de permission  
        $this->authorize('update', $user);
        //$user->update($this->params($request));

         // La validation de données
         $this->validate($request, [
            'name' => 'max:100',
            'coderfid' => 'min:7|unique:student',
            'users_id' => 'min:1',
            'classroom_id' => 'min:1',
        ]);

        // On modifie les informations de l'utilisateur
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->coderfid = $request->coderfid;
        $student->users_id = $request->users_id;
        $student->classroom_id = $request->classroom_id;
        $student->save();

        // On retourne la réponse JSON
        return response()->json($student);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student,Request $request,$id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json("succes");
    }
}
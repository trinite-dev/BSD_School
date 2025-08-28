<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfesseurController extends Controller
{
    protected $prof;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        //vérification de permission
         $this->authorize('viewAny', $user);
         //$user->create($this->params($request));

        // On récupère tous les utilisateurs
        $prof = DB::table('users')
                ->join('subjects','users.subjects_id', '=', 'subjects.id')
                ->join('role', 'users.role_id', '=','role.id' )
                ->where('role.name', '=', "Professeur")
                ->select('users.*', 'subjects.name as subjects_name','role.name as role_name')
                ->get()
        ;

        // On retourne les informations des utilisateurs en JSON
        return response()->json($prof);
    }
}
<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProprieteRepository;

class DashboardController extends Controller
{
    protected $mediocre;
    protected $passable;
    protected $bien;
    protected $excellent;
    protected $total;
    protected $nbrmed;
    protected $nocompr;
    public $from;
    public $to;

    public $data;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //return $request->user();
         //vérification de permission
         $this->authorize('view-admin');
         

        $this->validate($request, [
            'classroom_id' => 'required|max:10',
            'subjects_id' => 'required|max:10',
            'date_deb' =>'required|min:8',
            'date_fin' =>'required|min:8'
        ]);
        
        $from=Carbon::createFromFormat("d/m/Y",$request->date_deb)->format('Ymd');
        $to=Carbon::createFromFormat("d/m/Y",$request->date_fin)->format('Ymd');

        $mediocre= Opinion::join('presences', 'presences.id', '=', 'opinion.presences_id')
                            ->where('presences.classroom_id', '=', $request->classroom_id)
                            ->where('presences.subjects_id', '=', $request->subjects_id)
                            ->whereBetween(DB::raw('DATE(opinion.created_at)'), [$from, $to])
                            ->where('type', '=', "Mediocre")
                            ->count('*');

        $passable= Opinion::join('presences', 'presences.id', '=', 'opinion.presences_id')
                            ->where('presences.classroom_id', '=', $request->classroom_id)
                            ->where('presences.subjects_id', '=', $request->subjects_id)
                            ->whereBetween(DB::raw('DATE(opinion.created_at)'), [$from, $to])
                            ->where('type', '=', "Passable")
                            ->count('*');

        $bien= Opinion::join('presences', 'presences.id', '=', 'opinion.presences_id')
                        ->where('presences.classroom_id', '=', $request->classroom_id)
                        ->where('presences.subjects_id', '=', $request->subjects_id)
                        ->whereBetween(DB::raw('DATE(opinion.created_at)'), [$from, $to])
                        ->where('type', '=', "Bien")
                        ->count('*');
       
        $excellent= Opinion::join('presences', 'presences.id', '=', 'opinion.presences_id')
                        ->where('presences.classroom_id', '=', $request->classroom_id)
                        ->where('presences.subjects_id', '=', $request->subjects_id)
                        ->whereBetween(DB::raw('DATE(opinion.created_at)'), [$from, $to])
                        ->where('type', '=', "Excellent")
                        ->count('*');

        $total=Opinion::join('presences', 'presences.id', '=', 'opinion.presences_id')
                        ->join('users', 'users.id', '=', 'presences.users_id')
                        ->join('role', 'role.id', '=', 'users.role_id')
                        ->join('classroom', 'classroom.id', '=', 'presences.classroom_id')
                        ->join('subjects', 'subjects.id', '=', 'users.subjects_id')
                        ->whereBetween(DB::raw('DATE(opinion.created_at)'), [$from, $to])
                        ->where('type', '=', "Mediocre")
                        ->where('role.name', '=', "Professeur")
                        ->distinct()
                        ->select('subjects.name as subjects_name', 'users.name as users_name', 'classroom.name as classroom_name')
                        ->get()
                       ;
        
               
        $nocompr=Opinion::join('presences', 'presences.id', '=', 'opinion.presences_id')
            ->join('users', 'users.id', '=', 'presences.users_id')
            ->join('classroom', 'classroom.id', '=', 'presences.classroom_id')
            ->join('subjects', 'subjects.id', '=', 'users.subjects_id')
            ->whereBetween(DB::raw('DATE(opinion.created_at)'), [$from, $to])
            ->where('type','=',"Mediocre")
            ->distinct()
            ->select(DB::raw('count(opinion.student_id) as number_of_student, classroom.name as classroom_name,subjects.name as subjects_name'))
            ->groupBy('classroom_name')
            ->orderBy('subjects_name')
            ->get()
            ;


        $nbrmed=$mediocre+$passable+$bien+$excellent; 
                     

    $data=[$mediocre, $passable, $bien, $excellent, $nbrmed,$total, $nocompr];
                                           
        return response()->json($data);

    }
};

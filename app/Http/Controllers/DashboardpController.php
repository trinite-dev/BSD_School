<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProprieteRepository;

class DashboardpController extends Controller
{
    protected $mediocre;
    protected $passable;
    protected $bien;
    protected $excellent;
    protected $matmed;

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
    public function index(User $user, Request $request)
    {

        //vérification de permission
        $this->authorize('view-parent');


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

       
        
        $matmed= Opinion::join('presences', 'presences.id', '=', 'opinion.presences_id')
                        ->join('users', 'users.id', '=', 'presences.users_id')
                        ->join('subjects', 'subjects.id', '=', 'users.subjects_id')
                        ->join('student', 'student.id', '=', 'opinion.student_id') 
                        ->where('student.users_id', '=', $user->id)                       
                        ->where('type', '=', "Mediocre")
                        ->distinct()
                        ->selectRaw('subjects.name as subjects_name')
                        ->get();

        $nbrmed=$mediocre+$passable+$bien+$excellent;    

$data=[$mediocre, $passable, $bien, $excellent, $nbrmed, $matmed];
                               
return response()->json($data);

       

    }
};

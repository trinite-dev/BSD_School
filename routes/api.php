<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KitbsdController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresencesController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\DashboardpController;
use App\Http\Controllers\DashboardtController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ProgrammeUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::apiResource("users", UserController::class); // Les routes "users.*" de l'API 




//Public routes
Route::post('/login', [UserController::class, 'login']);




Route::group(["middleware"=>["auth:sanctum"]], function () {

//classroom
Route::get('/index/classroom', [ClassroomController::class,'index']);
Route::get('/show/classroom/{id}', [ClassroomController::class,'show']);
Route::post('/store/classroom', [ClassroomController::class,'store']);
Route::post('/update/classroom/{id}', [ClassroomController::class,'update']);
Route::delete('/delete/classroom/{id}', [ClassroomController::class,'destroy']);


//dashboard
Route::post('/dashboard', [DashboardController::class,'index']);
Route::post('/dashboardp', [DashboardpController::class,'index']);
Route::post('/dashboardt', [DashboardtController::class,'index']);

//group
Route::get('/index/group', [GroupController::class,'index']);
Route::get('/show/group/{id}', [GroupController::class,'show']);
Route::post('/store/group', [GroupController::class,'store']);
Route::post('/update/group/{id}', [GroupController::class,'update']);
Route::delete('/delete/group/{id}', [GroupController::class,'destroy']);

//kitbsd
Route::get('/index/kitbsd', [KitbsdController::class,'index']);
Route::get('/show/kitbsd/{id}', [KitbsdController::class,'show']);
Route::post('/store/kitbsd', [KitbsdController::class,'store']);
Route::post('/update/kitbsd/{id}', [KitbsdController::class,'update']);
Route::delete('/delete/kitbsd/{id}', [KitbsdController::class,'destroy']);

//opinion
Route::get('/index/opinion', [OpinionController::class,'index']);
Route::get('/show/opinion/{id}', [OpinionController::class,'show']);
Route::post('/store/opinion', [OpinionController::class,'store']);
//Route::post('/update/opinion', [OpinionController::class,'update']);
Route::delete('/delete/opinion/{id}', [OpinionController::class,'destroy']);

//presences
Route::get('/index/presences', [PresencesController::class,'index']);
Route::get('/show/presences/{id}', [PresencesController::class,'show']);
Route::post('/store/presences', [PresencesController::class,'store']);
//Route::post('/update/presences/{id}', [PresencesController::class,'update']);
//Route::delete('/delete/presences/{id}', [PresencesController::class,'destroy']);


//matiere 
Route::get('/index/subjects', [SubjectsController::class,'index']);
Route::get('/show/subjects/{id}', [SubjectsController::class, 'show']);
Route::post('/store/subjects', [SubjectsController::class,'store']);
Route::post('/update/subjects/{id}', [SubjectsController::class,'update']);
Route::delete('/delete/subjects/{id}', [SubjectsController::class,'destroy']);

//role
Route::get('/index/role', [RoleController::class,'index']);
Route::get('/show/role/{id}', [RoleController::class,'show']);
Route::post('/store/role', [RoleController::class,'store']);
Route::post('/update/role/{id}', [RoleController::class,'update']);
Route::delete('/delete/role/{id}', [RoleController::class,'destroy']);

//student
Route::get('/index/student', [StudentController::class,'index']);
Route::get('/show/student/{id}', [StudentController::class,'show']);
Route::post('/store/student', [StudentController::class,'store']);
Route::post('/update/student/{id}', [StudentController::class,'update']);
Route::delete('/delete/student/{id}', [StudentController::class,'destroy']);

//programme
Route::get('/index/program', [ProgrammeController::class,'index']);
Route::get('/show/program/{id}', [ProgrammeController::class,'show']);
Route::post('/store/program', [ProgrammeController::class,'store']);
Route::post('/update/program/{id}', [ProgrammeController::class,'update']);
Route::delete('/delete/program/{id}', [ProgrammeController::class,'destroy']);

//programme_user
Route::get('/index/programme', [ProgrammeUserController::class,'index']);
Route::get('/show/programme/{id}', [ProgrammeUserController::class,'show']);
Route::post('/store/programme', [ProgrammeUserController::class,'store']);
Route::post('/update/programme/{id}', [ProgrammeUserController::class,'update']);
Route::delete('/delete/programme/{id}', [ProgrammeUserController::class,'destroy']);

//user
Route::post('/me', [UserController::class, 'me']);
Route::get('/show/{id}', [UserController::class, 'show']);
Route::post('/update/{id}', [UserController::class,'update']);
Route::post('/edit/{id}', [UserController::class,'edit']);
Route::delete('/delete/{id}', [UserController::class, 'destroy']);

Route::post('/store', [UserController::class,'store']);
Route::get('/logout', [UserController::class,'logout']);
Route::get('/index', [UserController::class,'index']);

Route::get('/index/prof', [ProfesseurController::class,'index']);

});
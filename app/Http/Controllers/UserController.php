<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
         //vérification de permission
         $this->authorize('viewAny', $user);
        // On récupère tous les utilisateurs
        $user = User::all();

        // On retourne les informations des utilisateurs en JSON
        return response()->json($user);
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id , User $user)
    {
         //vérification de permission 
         $this->authorize('view', $user);

         $user = User::findOrFail($id);
        // On retourne les informations de l'utilisateur en JSON
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Role $role)
    {
        //vérification de permission  
        $this->authorize('create', $user);

        // La validation de données
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'coderfid' => 'string|min:7|unique:users',
            'phone' => 'required|integer|min:7',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer|min:1',
            'subjects_id' => 'integer|min:1',
        ]);

        // On crée un nouvel utilisateur
        $user = User::create([
            'name' => $request->name,
            'coderfid' => $request->coderfid,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'subjects_id' => $request->subjects_id,
        ]);

        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json($user);
    }


// Nous renvoyons simplement le compte utilisateur actuellement authentifié.

public function me(Request $request)
{
return $request->user();
}

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id,User $user)
    {
         //vérification de permission  
         $this->authorize('edit', $user);

        $this->validate($request, [
            'name' => 'max:100',
            'coderfid' => 'min:7|unique:users',
            'phone' => 'min:7',
            'email' => 'email|unique:users',
            'password' => 'min:8',
            'role_id' => 'max:100',
            'subjects_id' => 'max:100',
        ]);

       
        // On modifie les informations de l'utilisateur
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->coderfid = $request->coderfid;
        $user->phone = $request->phone;
        $user->email = $request->email;
        if ($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->subjects_id = $request->subjects_id;
        $user->role_id = $request->role_id;
        $user->save();
        // On retourne la réponse JSON
        return response()->json($user);
      
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id,User $user)
    {
        //vérification de permission  
        $this->authorize('update', $user);

        // La validation de données
        $this->validate($request, [
            'name' => 'max:100',
            'coderfid' => 'min:7|unique:users',
            'phone' => 'min:7',
            'email' => 'email|unique:users',
            'password' => 'min:8',
            'subjects_id' => 'min:1',
        ]);


        // On modifie les informations de l'utilisateur
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->coderfid = $request->coderfid;
        $user->phone = $request->phone;
        $user->email = $request->email;
        if ($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->subjects_id = $request->subjects_id;

        $user->save();
        // On retourne la réponse JSON
        return response()->json($user);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
        'message' => 'Invalid login details'
                   ], 401);
               }
        
        $user = User::where('email', $request['email'])->firstOrFail();
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
                   'access_token' => $token,
                   'token_type' => 'Bearer',
        ]);
    }

   

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $user = Auth::user();
        $this->authorize('logout', $user);

        Auth::user()->tokens()->delete();
        return response()->json("succes");
       //return redirect('index.vue');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$id)
    {
         //vérification de permission 
         $this->authorize('delecte', $user);

        // On supprime l'utilisateur
        $user = User::findOrFail($id);
        $user->delete();

        // On retourne la réponse JSON
        return response()->json("succes");
    }

    private function params(){
        return $request->all();
    }
}

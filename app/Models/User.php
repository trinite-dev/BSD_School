<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','coderfid','phone','email',])
        ->useLogName('user');
        // Chain fluent methods for configuration options
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'name',
        'coderfid',
        'phone',
        'email',
        'password',
        'role_id',
        'subjects_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

      /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array  $abilities
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name, array $abilities = ['*'])
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(256)),
            'abilities' => $abilities,
        ]);

        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }

   // DB::table('role')->where('name','=',"Administrateur")->select('role.id')->get();
    public function isAdmin()
    {
        return str_contains($this->role->name, 'Administrateur');
    }

    public function isParent()
    {
        return str_contains($this->role->name, 'Parent');
    }

    public function isProfesseur()
    {
        return str_contains($this->role->name, 'Professeur');
    }

    public function role()
    { 
        return $this->belongsTo(Role::class); 
    }

    public function subjects()
    { 
        return $this->belongsTo(Subjects::class); 
    }

    public function student() 
    { 
        return $this->hasMany(Student::class); 
    }

    public function presences() 
    { 
        return $this->hasMany(Presences::class); 
    }

    public function programme() 
    { 
        
        return $this->belongsToMany(Programme::class)->using(ProgrammeUser::class);
    }

}

<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    protected $table = 'student';

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','coderfid', 'classroom_id'])
        ->useLogName('user');
        // Chain fluent methods for configuration options
    }
    protected $fillable = [
        'name',
        'coderfid',
        'users_id',
        'classroom_id',
    ];

    /*public function isInclass()
    {
        return $this->classroom_id === 'Admin';
    }*/

    public function users()
    { 
        return $this->belongsTo(User::class); 
    }

    public function opinion() 
    { 
        return $this->hasMany(Opinion::class); 
    }

    public function classroom()
    { 
        return $this->belongsTo(Classroom::class); 
    }
}

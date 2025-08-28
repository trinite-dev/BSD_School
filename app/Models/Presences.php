<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presences extends Model
{
    protected $table = 'presences';

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['users_id'])
        ->useLogName('user');
        // Chain fluent methods for configuration options
    }
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subjects_id',
        'users_id',
        'classroom_id',
        'startat',
    ];

    public function users()
    { 
        return $this->belongsTo(User::class); 
    }

    public function subjects()
    { 
        return $this->belongsTo(Subjects::class); 
    }

    public function classroom()
    { 
        return $this->belongsTo(Classroom::class); 
    }

    public function opinion() 
    { 
        return $this->hasMany(Opinion::class); 
    }
}

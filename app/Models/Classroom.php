<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class classroom extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name'])
        ->useLogName('user');
        // Chain fluent methods for configuration options
    }

    protected $table = 'classroom';
    
    protected $fillable = [
    'name',
    'kitbsd_id',
    'group_id',
    ];

    public function student() 
    { 
        return $this->hasMany(Student::class); 
    }

    public function group()
    { 
        return $this->belongsTo(Group::class); 
    }

    public function kitbsd()
    { 
        return $this->belongsTo(Kitbsd::class);
    }

    public function presences() 
    { 
        return $this->hasMany(Presences::class); 
    }

    public function programme() 
    { 
        return $this->hasMany(Programme::class); 
    }
}

<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subjects extends Model
{
    protected $table = 'subjects';

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name'])
        ->useLogName('user');
        // Chain fluent methods for configuration options
    }
    protected $fillable = [
        'name',
    
    ];

    public function users() 
    { 
        return $this->hasMany(User::class); 
    }

    public function presences() 
    { 
        return $this->hasMany(Presences::class); 
    }
}

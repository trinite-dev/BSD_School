<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class group extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name'])
        ->useLogName('user');
        // Chain fluent methods for configuration options
    }
    protected $table = 'group';
    
    protected $fillable = [
        'name',
        
    ];

    public function classroom() 
    { 
        return $this->hasMany(Classroom::class); 
    }

}

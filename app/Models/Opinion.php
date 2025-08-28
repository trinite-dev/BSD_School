<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opinion extends Model
{
    protected $table = 'opinion';

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['type'])
        ->useLogName('user');
        // Chain fluent methods for configuration options
    }
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'student_id',
        'presences_id',
    ];


    public function presences()
    { 
        return $this->belongsTo(Presences::class); 
    }

    public function student()
    { 
        return $this->belongsTo(Student::class); 
    }
}

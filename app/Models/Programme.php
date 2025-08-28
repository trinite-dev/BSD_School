<?php

namespace App\Models;

use App\Models\User;
use App\Models\Classroom;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programme extends Model
{
    protected $table = 'programme';

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['day',
        'hour','classroom_id','subjects_id'])
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
        'classroom_id',
        'day',
        'hour',
    ];

    public function classroom()
    { 
        return $this->belongsTo(Classroom::class); 
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(ProgrammeUser::class);
    }
}

<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kitbsd extends Model
{
    protected $table = 'kitbsd';
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['coderfid'])
        ->useLogName('user');
        // Chain fluent methods for configuration options
    }
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'coderfid',
    ];

    public function classroom() 
    { 
        return $this->belongsTo(classroom::class); 
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\Traits\LogsActivity;

class ProgrammeUser extends Pivot
{
   use LogsActivity;

   public $incrementing = true;

   // protected $fillable = [
   //     'users_id',
   //     'programme_id',
   // ];
}

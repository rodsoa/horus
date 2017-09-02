<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function work_schedules () {
        return $this->hasMany('Horus\Models\WorkSchedule');
    }
}

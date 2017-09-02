<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'name',
        'address',
        'description',
        'status'
    ];

    public function work_schedules () {
        return $this->hasMany('Horus\Models\WorkSchedule');
    }
}

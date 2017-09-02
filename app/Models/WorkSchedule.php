<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    public function building () {
        return $this->belongsTo('Horus\Models\Building');
    }

    public function schedule () {
        return $this->belongsTo('Horus\Models\Schedule');
    }

    public function employee () {
        return $this->belongsTo('Horus\Models\Employee');
    } 
}

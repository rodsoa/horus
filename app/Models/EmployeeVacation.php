<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeVacation extends Model
{
    public function employee() {
        return $this->belongsTo('Horus\Models\Employee');
    }
}

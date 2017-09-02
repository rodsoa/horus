<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeCategory extends Model
{
    public function employees() {
        return $this->hasMany('Horus\Models\Employee');
    }
}

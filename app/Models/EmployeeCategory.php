<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeCategory extends Model
{
    protected $fillable = [
        'name'
    ];

    public function employees() {
        return $this->hasMany('Horus\Models\Employee');
    }
}

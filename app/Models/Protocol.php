<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $fillable = [
        'category',
        'employee_id',
        'building_id'
    ];

    public function employee () {
        return $this->belongsTo('Horus\Models\Employee');
    }

    public function building () {
        return $this->belongsTo('Horus\Models\Building');
    }
}

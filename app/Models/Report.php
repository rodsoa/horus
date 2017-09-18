<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'description',
        'employee_id',
        'building_id',
        'schedule_id',
        'user_id'
    ];

    public function report_images() {
        return $this->hasMany('Horus\Models\ReportImage');
    }

    public function building() {
        return $this->belongsTo('Horus\Models\Building');
    }

    public function employee() {
        return $this->belongsTo('Horus\Models\Employee');
    }

    public function schedule() {
        return $this->belongsTo('Horus\Models\Schedule');
    }

    public function user() {
        return $this->belongsTo('Horus\User');
    }
}

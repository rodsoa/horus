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
        'work_schedule_id'
    ];

    public function report_images() {
        return $this->hasMany('Horus\Models\ReportImage');
    }

    public function work_schedule() {
        return $this->belongsTo('Horus\Models\WorkSchedule');
    }

    public function building() {
        return $this->belongsTo('Horus\Models\Building');
    }

    public function employee() {
        return $this->belongsTo('Horus\Models\Employee');
    }
}

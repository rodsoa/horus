<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model
{
    public function report() {
        return $this->belongsTo('Horus\Models\Report');
    }
}

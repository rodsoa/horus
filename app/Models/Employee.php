<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'employee_category_id',
        'photo',
        'phone',
        'cell_phone',
        'email',
        'address'
    ];

    public function employee_category () {
        return $this->belongsTo('Horus\Models\EmployeeCategory');
    }

    public function generateRegistrationNumber() {
        if ( isset($this->registration_number) )
            return $this->registraion_number;

        $rgn = (new \DateTime('NOW'))->format('dmYHis') . $this->name[0] . $this->name[1];
        return $rgn;
    }
}

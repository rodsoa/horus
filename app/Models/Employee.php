<?php

namespace Horus\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'employee_category_id',
        'registration_number',
        'photo',
        'phone',
        'cell_phone',
        'email',
        'address'
    ];

    public function employee_vacations() {
        return $this->hasMany('Horus\Models\EmployeeVacation');
    }

    public function employee_category() {
        return $this->belongsTo('Horus\Models\EmployeeCategory');
    }

    public function work_schedules() {
        return $this->hasMany('Horus\Models\WorkSchedule');
    }

    public function protocols() {
        return $this->hasMany('Horus\Models\Protocol');
    }

    public function user() {
        return $this->hasOne('Horus\User');
    }

    public function getActualWorkPlaces() {
        $building_ids = [];

        // obtendo lista de ids das unidades
        foreach( $this->work_schedules as $ws ) {
            $building_ids[] = $ws->building_id;
        }

        // removendo valores duplicados
        $building_ids = array_unique( $building_ids );

        $query = [];

        // Pegando o nome das construções
        $buildings = \Horus\Models\Building::find($building_ids);

        if( count( $buildings ) ){
            $names = [];
            foreach( $buildings as $b ) $names[] = $b->name;
            return $names;
        } else {
            return [];
        }
    }

    public function getHoursWorked() {
        $month = (new \DateTime('now'))->format('m');
        $total = 0;
        foreach($this->work_schedules as $ws)
            if ( ((\DateTime::createFromFormat('Y-m-d', $ws->date))->format('m') === (new \DateTime('now'))->format('m'))){
                // Verificando ano corrente!
                $data = explode("-", $ws->date);
                if ( ($data[0] === (new \DateTime('now'))->format('Y')) && ($data[1] === $month) )
                    $total += $ws->schedule->hours;
            }
        return $total;
    }
}

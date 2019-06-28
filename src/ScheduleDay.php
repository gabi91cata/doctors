<?php

namespace Consultadoctor\Doctors;

use Illuminate\Database\Eloquent\Model;

class ScheduleDay extends Model
{
    public function getNameAttribute()
    {
        $arr = ["Duminica","Luni","Marti","Miercuri","Joi","Vineri","Sambata", "Duminica"];
        return $arr[$this->day];
    }
}

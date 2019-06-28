<?php

namespace Consultadoctor\Doctors;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function days()
    {
        return $this->hasMany(ScheduleDay::class);
    }
    public function scheduleable()
    {
        return $this->morphTo();
    }

}

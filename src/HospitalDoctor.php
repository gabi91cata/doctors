<?php

namespace Consultadoctor\Doctors;

use Illuminate\Database\Eloquent\Model;

class HospitalDoctor extends Model
{
    public function getMorphClass()
    {
        return "Consultadoctor\Doctors\HospitalDoctor";
    }
 
    public function schedules()
    {
        return $this->morphMany(Schedule::class, 'scheduleable');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}

<?php

namespace Consultadoctor\Doctors;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    public function getNameAttribute()
    {
        return "$this->last_name $this->first_name";
    }
    public function specialities()
    {
        return $this->belongsToMany(Speciality::class, 'speciality_doctor');
    }

    public function hospitals()
    {
        return $this->hasMany(HospitalDoctor::class);
    }

    public function hospitalsB()
    {
        return $this->belongsToMany(Hospital::class, 'hospital_doctors');
    }

    public function schedules()
    {
        return $this->morphMany(Schedule::class, 'scheduleable');
    }


}

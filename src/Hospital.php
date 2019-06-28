<?php

namespace Consultadoctor\Doctors;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'hospital_doctors')->withPivot('id', 'first_free');
    }

}

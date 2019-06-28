<?php

namespace Consultadoctor\Appointments\Http;

use App\Http\Controllers\Controller; 
use Consultadoctor\Doctors\Doctor; 

class AppointmentsController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors::index', compact('doctors'));
    }
    
}

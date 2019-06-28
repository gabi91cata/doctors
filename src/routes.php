<?php
/**
 * Created by PhpStorm.
 * User: gabi
 * Date: 2019-01-21
 * Time: 22:14
 */

use Illuminate\Support\Facades\Route;
 
Route::middleware('web')
    ->namespace("Consultadoctor\Doctors\Http")
    ->group(function($route){ 
        $route->resource('admin/doctors', 'Admin\DoctorController', [
            'as' => 'admin'
        ]);
        
        $route->resource('admin/schedule', 'Admin\ScheduleController', [
            'as' => 'admin'
        ]);


        $route->get('admin/doctor/{doctor}/hospital/{id}', 'Admin\DoctorController@addHospital')->name('admin.doctor.hospital');

    }); 

 
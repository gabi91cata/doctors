<?php

namespace Consultadoctor\Doctors\Http\Admin;
 
use Consultadoctor\Doctors\HospitalDoctor;
use Consultadoctor\Doctors\Schedule;
use Consultadoctor\Doctors\ScheduleDay;
use Illuminate\Http\Request;
use Artisan;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hd = HospitalDoctor::find($request->get('doctor_hospital'));

        $schedule = new Schedule();
        $schedule->type = $request->type;

        $a = $hd->schedules()->save($schedule);

        $request->session()->flash('success', 'Am creat un nou orar pentru tine. <br/> Adauga mai departe orele si celelalte detalii.');


        return redirect()->route('admin.schedule.edit', [
            "schedule" => $schedule->id
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Schedule $schedule)
    {

        if($schedule->scheduleable instanceof HospitalDoctor)
            $hospital_doctor = $schedule->scheduleable;


        return view('doctors::admin.schedule', compact(   'hospital_doctor','schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->session()->flash('success', 'Orarul a fost salvat cu succes.');

        $schedule->type = $request->type;
        $schedule->interval = $request->interval;
        $schedule->valid_from = $request->valid_from;
        $schedule->valid_to = $request->valid_to;
        $schedule->days()->delete();



        foreach ($request->day["start"] as $day => $value)
        {
            if($value != null)
            {
                $scheduleDay = new ScheduleDay();
                $scheduleDay->day = $day;
                $scheduleDay->start_at = $value;
                $scheduleDay->end_at = $request->day["end"][$day]; 
                $schedule->days()->save($scheduleDay);
            }
 
        }
        $schedule->save();

        if($schedule->scheduleable instanceof HospitalDoctor)
            $doctor = $schedule->scheduleable->doctor;

        Artisan::call('cache:clear');

        return redirect()->route('admin.doctors.edit', ['doctor' => $doctor->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Schedule $schedule)
    {

        if($schedule->scheduleable instanceof HospitalDoctor)
            $doctor = $schedule->scheduleable->doctor;
        $schedule->delete();
        return redirect()->route('admin.doctors.edit', ['doctor' => $doctor->id]);
    }
}

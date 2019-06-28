<?php

namespace Consultadoctor\Doctors\Http\Admin;

use Consultadoctor\Doctors\Doctor;
use Consultadoctor\Doctors\Hospital;
use App\Http\Requests\AdminDoctorRequest;
use Consultadoctor\Doctors\Speciality;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleXMLElement;
use Vyuldashev\XmlToArray\XmlToArray;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors::admin.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialities = Speciality::all();
        $hospitals = Hospital::all();
        return view('doctors::admin.add', compact('specialities', 'hospitals'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminDoctorRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminDoctorRequest $request)
    {
        $request->session()->flash('success', 'Medicul a fost salvat cu succes');
        $doctor = new Doctor();
        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->phone = $request->phone;
        $doctor->stencil = $request->stencil;
        $doctor->gender = $request->gender;
        $doctor->save();
        if($request->hospital)
        foreach ($request->hospital as $id=>$h)
            $doctor->hospitalsB()->attach($id);

        return redirect()->route('admin.doctors.index');

    }

    public function addHospital(Doctor $doctor, $id)
    {
        if($id)
        $doctor->hospitalsB()->syncWithoutDetaching([$id]);
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {


        $files = Storage::files('reports');
        $file = $files[0];

        $xml = Storage::get($file);

        $xml = new SimpleXMLElement($xml);

        $s = [];
        foreach ($xml->clinicServices->clinicService as $c)
        {
            $s[] = json_decode(json_encode($c->attributes()), true)["@attributes"];
        }
        $c = collect($s);
        $casmb = $c->where("stencilNo", "=", $doctor->stencil);


        return view('doctors::admin.profile', compact(  'doctor', 'casmb'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $specialities = Speciality::all();

        return view('doctors::admin.edit', compact('specialities',  'doctor'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminDoctorRequest $request
     * @param  \App\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(AdminDoctorRequest $request, Doctor $doctor)
    {
        $request->session()->flash('success', 'Medicul a fost salvat cu succes');
        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->phone = $request->phone;
        $doctor->stencil = $request->stencil;
        $doctor->gender = $request->gender;
        if ($request->has('image'))
            $doctor->picture = $this->uploadFile($request->file('image'));
        $doctor->save();


        return redirect()->route('admin.doctors.index');

    }

    private function uploadFile($file)
    {

        $name = str_random(40);
        $image = "doctors/$name.png";
        $img = Image::make($file)->fit(150, 150);
        $img->save(storage_path($image), 100);
        Storage::disk('public')->put($image, (string)$img->getEncoded());
        $path = Storage::disk('public')->url($image);
        @unlink(storage_path($image));

        return $path;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}

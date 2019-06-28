@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">Medici</a></li> 
    <li class="breadcrumb-item active" aria-current="page">{{ $doctor->name }}</li>
  </ol>
</nav>
    <div class="row admin doctors">
        <div class="col-lg-8 col-md-12 col-sm-12  grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                       <div class="alert alert-danger">
                           @foreach ($errors->all() as $error)
                               <div class="text-small">{{$error}}</div>
                           @endforeach
                       </div>
                    @endif

                    <h4 class="card-title">Modifica medic</h4>
                        <form class="form-sample" id="saveForm" method="post" enctype="multipart/form-data"  action="{{ route('admin.doctors.update', [
                    'doctor' => $doctor->id]) }}">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                        </form>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Imagine</label>
                                    <div class="col-sm-9">
                                        <input form="saveForm" type="file" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nume</label>
                                    <div class="col-sm-9">
                                        <input form="saveForm" type="text" value="{{ old('first_name', $doctor->first_name) }}" name="first_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Prenume</label>
                                    <div class="col-sm-9">
                                        <input form="saveForm" type="text" value="{{ old('last_name', $doctor->last_name) }}"  name="last_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sex</label>
                                    <div class="col-sm-9">
                                        <select form="saveForm" class="form-control" name="gender">
                                            <option @if(old('gender', $doctor->gender) ==  'm') selected @endif value="m">Masculin</option>
                                            <option @if(old('gender', $doctor->gender) == 'f') selected @endif value="f">Feminin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Spec.</label>
                                    <div class="col-sm-9">
                                        <select form="saveForm" class="form-control" name="speciality">
                                            @foreach($specialities as $s)
                                                <option @if(old('speciality', $doctor->speciality) == $s->id) selected @endif value="{{ $s->id }}">{{$s->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Parafa</label>
                                    <div class="col-sm-9">
                                        <input form="saveForm" type="text" value="{{ old('stencil', $doctor->stencil) }}" class="form-control" name="stencil">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Telefon</label>
                                    <div class="col-sm-9">
                                        <input form="saveForm" type="text" value="{{ old('phone', $doctor->phone) }}" class="form-control" name="phone">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Orar</strong>

                            </div>
                            <div class="col-md-8">
                                <div class="bg-transparent text-right ">

                                    @foreach(\Consultadoctor\Doctors\Hospital::whereNotIn('id',$doctor->hospitalsB()->pluck('hospital_id')->toArray())->get() as $h)
                                        <a class="btn btn-sm btn-rounded btn-link" href="{{ route('admin.doctor.hospital', ['doctor'=>$doctor->id, 'id'=>$h->id]) }}">
                                            Adauga sediul {{ $h->name }}
                                        </a>
                                    @endforeach
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            @foreach($doctor->hospitals as $h)
                                <div class="col-md-12 mb-3 bg-light rounded shadow p-2">
                                    <table class="table table-sm border-0">
                                        <tr>
                                            <th width="200">
                                               {{ $h->hospital->name }}
                                            </th>
                                           
                                            <th colspan="2">
                                                <div class="row">
                                                <form method="post" class="inline-block"   action="{{ route('admin.schedule.store', ['doctor_hospital'=>$h->id]) }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="type" value="normal">
                                                    <button class="btn btn-xs btn-inverse-outline-info btn-rounded">
                                                        <i class="mdi mdi-plus"></i>Adauga orar
                                                    </button>
                                                </form>
                                                &nbsp; 
                                                <form method="post" class="inline-block"  action="{{ route('admin.schedule.store', ['doctor_hospital'=>$h->id]) }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="type" value="holiday">
                                                    <button class="btn btn-xs btn-inverse-outline-primary btn-rounded">
                                                        <i class="mdi mdi-plus"></i>Adauga concediu
                                                    </button>
                                                </form>
                                                </div>
                                            </th>
                                        </tr>
                                        @foreach($h->schedules as $s)
                                            <tr>
                                                <td width="200">
                                                    {{ $s->type }}
                                                </td>
                                                <td>
                                                    @foreach($s->days as $day)
                                                        {{ $day->name }},
                                                        @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.schedule.edit', ['schedule'=>$s->id]) }}" class="btn btn-xs btn-inverse-outline-warning btn-rounded">  <i class="mdi mdi-pencil"></i> Modifica</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>

                                </div>
                            @endforeach

                        </div>
                        <hr>
                        <button class="btn btn-success btn-rounded btn-loading" type="submit" form="saveForm">   <i class="mdi mdi-check"></i> Salveaza </button>


                        <a class="btn btn-light btn-rounded btn-loading"  href="{{ route('admin.doctors.index') }}" >   <i class="mdi mdi-back"></i> Renunta </a>



                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body d-flex flex-column">
                    <div class="wrapper">
                        <img src="{{ $doctor->picture }}" class="img-lg rounded-circle mb-2" alt="profile image">
                        <h4>{{ $doctor->name }}</h4>
                        <p class="text-muted">
                            @foreach($doctor->specialities as $s)
                                {{ $s->name }}
                            @endforeach

                        </p>

                    </div>

                </div>
            </div>
            <br/>

            @include('doctors::admin.tips')
        </div>
    </div>

@endsection
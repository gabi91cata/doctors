@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb"> 
    <li class="breadcrumb-item active" aria-current="page">Medici</li>
  </ol>
</nav>

    <div class="row admin doctors">



        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div>
                        <a class="btn btn-sm  btn-rounded btn-outline-primary" href="{{ route('admin.doctors.create') }}">
                           <span class="mdi mdi-plus"></span> Adauga medic
                            <i class="fa fa-book"></i>
                        </a>

                    </div>

                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table  table-sm table-hover">
                            <thead>
                            <tr>
                                <th width="10"></th>
                                <th>Medic</th>
                                <th>Sediu</th>
                                <th><i class="glyphicon glyphicon-flash"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <td>
                                        <img src="{{ $doctor->picture }}">
                                    </td>
                                    <td>
                                        <strong>{{ $doctor->first_name }}  {{ $doctor->last_name }}</strong>
                                        <br/>
                                        @foreach($doctor->specialities as $speciality)
                                            {{ $speciality->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($doctor->hospitals as $dh)
                                            <span class="badge badge-inverse-dark">{{ $dh->hospital->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-inverse-warning btn-rounded" href="{{ route('admin.doctors.edit', ['id' => $doctor->id]) }}">
                                            <i class="mdi mdi-pencil"></i> Modifica
                                        </a>

                                        <a class="btn btn-xs btn-inverse-info btn-rounded" href="{{ route('admin.doctors.show', ['id' => $doctor->id]) }}">
                                            <i class="mdi mdi-eye"></i> Vezi profil
                                        </a>

                                    </td>

                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
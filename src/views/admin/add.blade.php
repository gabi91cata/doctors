@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">Medici</a></li> 
    <li class="breadcrumb-item active" aria-current="page">Adauga medic</li>
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
 
                    <form class="form-sample" method="post"  action="{{ route('admin.doctors.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nume</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ old('first_name') }}" name="first_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Prenume</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ old('last_name') }}"  name="last_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sex</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="gender">
                                            <option @if(old('gender') ==  'm') selected @endif value="m">Masculin</option>
                                            <option @if(old('gender') == 'f') selected @endif value="f">Feminin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Spec.</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="speciality">
                                            @foreach($specialities as $s)
                                                <option @if(old('speciality') == $s->id) selected @endif value="{{ $s->id }}">{{$s->name}}</option>
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
                                        <input type="text" value="{{ old('stencil') }}" class="form-control" name="stencil">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Telefon</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ old('phone') }}" class="form-control" name="phone">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="row">

                            <div class="col-md-6">
                                <strong>Sediu</strong>
                                @foreach($hospitals as $h)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" @if(isset(old("hospital")["$h->id"])) checked @endif  value="true"  name="hospital[{{ $h->id }}]"  >
                                            {{ $h->name }}
                                            <i class="input-helper"></i></label>
                                    </div>
                                @endforeach


                            </div>

                            <div class="col-md-6">
                                <div class="bg-light text-small  p-3 rounded  ">
                                    <i class="mdi mdi-information text-info"></i> Pentru a adauga <strong>programul de lucru</strong> si <strong>serviciile</strong> mai intai trebuie sa salvezi
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-success btn-rounded" type="submit"> Salveaza </button>
                        <button class="btn btn-light btn-rounded"> Renunta </button>


                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            @include('doctors::admin.tips')

        </div>
    </div>

@endsection
@extends('layouts.app')



@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">Medici</a></li> 
    <li class="breadcrumb-item"><a href="{{ route('admin.doctors.edit', ['doctor'=>$hospital_doctor->doctor->id]) }}"> {{ $hospital_doctor->doctor->name }}</a></li> 
    <li class="breadcrumb-item active" aria-current="page">Orar #{{ $schedule->id }}</li>
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

                    <h4 class="card-title">Orar medic</h4>
                    <form class="form-sample" id="saveForm" method="post" enctype="multipart/form-data" action="{{ route('admin.schedule.update', [
                    'schedule' => $schedule->id]) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                    </form>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tip</label>
                                    <div class="col-sm-9">
                                        <select  class="form-control" form="saveForm" name="type">
                                            <option value="normal" @if($schedule->type == "normal") selected @endif>Normal</option>
                                            <option value="holiday"  @if($schedule->type == "holiday") selected @endif>Vacanta</option>
                                            {{-- <option value="even" @if($schedule->type == "even") selected @endif>Saptamana para</option>
                                            <option value="odd" @if($schedule->type == "odd") selected @endif>Saptamana Impara</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Data inceput</label>
                                    <div class="col-sm-9">
                                        <input type="date" form="saveForm" value="{{ old('valid_from', $schedule->valid_from) }}"
                                               name="valid_from" class="form-control">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Interval</label>
                                    <div class="col-sm-9">
                                        <input type="number" form="saveForm" value="{{ old('interval', $schedule->interval) }}"
                                               name="interval" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Data sfarsit</label>
                                    <div class="col-sm-9">
                                        <input type="date" form="saveForm" value="{{ old('valid_to', $schedule->valid_to) }}"
                                               name="valid_to" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

 
                        <div class="row hours">
                            <div class="col-md-12">
                                <table class="table table-sm" >
                                    <tr>
                                        <td>#</td>
                                        <td>Luni</td>
                                        <td>Marti</td>
                                        <td>Miercuri</td>
                                        <td>Joi</td>
                                        <td>Vineri</td>
                                        <td>Sambata</td>
                                        <td>Duminica</td>
                                    </tr>

                                    <tr>
                                        @php
                                            $daysStart = $schedule->days()->pluck('start_at', 'day')->toArray();
                                            $daysEnd = $schedule->days()->pluck('end_at', 'day')->toArray(); 
                                            if(!isset($days[0])) $days[0] = null;
                                            if(!isset($days[1])) $days[1] = null;
                                            if(!isset($days[2])) $days[2] = null;
                                            if(!isset($days[3])) $days[3] = null;
                                            if(!isset($days[4])) $days[4] = null;
                                            if(!isset($days[5])) $days[5] = null;
                                            if(!isset($days[6])) $days[6] = null;
                                            if(!isset($days[7])) $days[7] = null;
                                        @endphp
                                        <td>
                                            De la
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[start][1]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                                "selected"=> isset($daysStart[1])?$daysStart[1]:null
                                                ]) @endcomponent
                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[start][2]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                             "selected"=> isset($daysStart[2])?$daysStart[2]:null
                                             ]) @endcomponent
                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[start][3]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                             "selected"=> isset($daysStart[3])?$daysStart[3]:null
                                             ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[start][4]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                            "selected"=> isset($daysStart[4])?$daysStart[4]:null
                                            ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[start][5]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                             "selected"=> isset($daysStart[5])?$daysStart[5]:null
                                             ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[start][6]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                             "selected"=> isset($daysStart[6])?$daysStart[6]:null
                                             ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[start][7]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                             "selected"=> isset($daysStart[7])?$daysStart[7]:null
                                             ]) @endcomponent
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Pana la
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[end][1]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                             "selected"=>  isset($daysEnd[1])?$daysEnd[1]:null
                                             ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[end][2]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                          "selected"=> isset($daysEnd[2])?$daysEnd[2]:null
                                          ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[end][3]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                          "selected"=> isset($daysEnd[3])?$daysEnd[3]:null
                                          ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[end][4]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                          "selected"=> isset($daysEnd[4])?$daysEnd[4]:null
                                          ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[end][5]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                          "selected"=> isset($daysEnd[5])?$daysEnd[5]:null
                                          ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[end][6]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                          "selected"=> isset($daysEnd[6])?$daysEnd[6]:null
                                          ]) @endcomponent

                                            </select>
                                        </td>
                                        <td>
                                            <select form="saveForm" class="form-control form-control-sm" name="day[end][7]">
                                                <option value="">-</option>
                                                @component('doctors::admin.hours', [
                                           "selected"=> isset($daysEnd[7])?$daysEnd[7]:null
                                           ]) @endcomponent

                                            </select>
                                        </td>
                                    </tr>
                                     

                                </table>
                            </div>

                        </div>
 

                        <hr>
                        <form class="form-sample" id="deleteForm" method="post" enctype="multipart/form-data" action="{{ route('admin.schedule.destroy', [
                    'schedule' => $schedule->id]) }}">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                        </form>

                        <button form="saveForm" class="btn btn-success btn-rounded btn-loading" type="submit"><i
                                    class="mdi mdi-check"></i> Salveaza
                        </button>


                        <button form="deleteForm" class="btn btn-inverse-danger btn-rounded"> Sterge</button>


                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body d-flex flex-column">
                    <div class="wrapper">
                        <img src="{{ $hospital_doctor->doctor->picture }}" class="img-lg rounded-circle mb-2" alt="profile image">
                        <h4>{{ $hospital_doctor->doctor->name }}</h4>
                        <p>{{ $hospital_doctor->hospital->name }}</p>


                    </div>

                </div>
            </div>
            <br/>

            @include('doctors::admin.tips')
        </div>
    </div>

@endsection
@section('scripts')
<script>
    $(function(){
        function hideHours(val)
        {
            if(val == 'holiday')
                $(".admin.doctors .hours").hide();
            if(val == 'normal')
                $(".admin.doctors .hours").show();
                console.log(val);
        }
        $('[name="type"]').on('change', function(){
            var val = $(this).val();
            hideHours(val);
        });
        hideHours($('[name="type"]').val());


    })
</script>
@endsection
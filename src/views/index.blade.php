@extends('layouts.app')

@section('content')
 
    <div class="  appointments">
          
                    <div class="card">
        
        
                        <div class="card-body">
                            <h3 class="card-title">
        
                                Pacienti Programati
        
                            </h3>
        
        
        
        
                            {{-- <div class="mt-2">
                                    <button type="button" class="btn btn-sm btn-icons btn-rounded btn-secondary">
                                        <i class="mdi mdi-printer"></i>
                                    </button>
                                    &nbsp;
                                    <button type="button" class="btn   btn-sm btn-rounded btn-primary">
                                        <i class="mdi mdi-plus"></i> Adauga
                                    </button>
                                </div> --}}
                            <div class="table-responsive">
                                <table class="table table-sm table-hover table-bordered">
                                    <tr>
                                        <th width="10"> </th>
                                        <th width="14.28%">Luni</th>                                         
                                        <th width="14.28%">Marti</th>                                         
                                        <th width="14.28%">Miercuri</th>                                         
                                        <th width="14.28%">Joi</th>                                         
                                        <th width="14.28%">Vineri</th>                                         
                                        <th width="14.28%">Sambata</th>                                 
                                        <th width="14.28%">Duminica</th> 
                                        
        
                                    </tr>
                                   
                                    @for($i=strtotime('2019-05-05 07:00:00'); $i< strtotime('2019-05-05 20:00:00'); $i+=20*60)
                                    <tr>
                                        <td>{{ date("H:i", $i) }}</td>
                                        <td><div class="empty-slot"></div></td>  
                                        <td><div class="empty-slot"></div></td>  
                                        <td> 
                                            @if(date("H:i", $i)=="12:00") 
                                            
                                                <div style="height:201%;" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." class="used-slot"></div>
                                                <span class="appointment-slot">
                                                        Gabi Brosteanu 
                                                </span>
                                             @else
                                            <div class="empty-slot"></div>
                                            @endif</td>  
                                        <td hour="{{ date("H:i", $i) }}"><div class="empty-slot"></div></td>  
                                        <td><div class="empty-slot"></div></td>   
                                        <td><div class="empty-slot"></div></td>   
                                        <td><div class="empty-slot"></div></td> 
                                    </tr>
                                     
                                    @endfor
                                </table>
        
                            </div>
                        </div>
                    </div>
        

    </div>

@endsection

@section('sidebar')
<nav class="sidebar sidebar-offcanvas sidebar-apps" id="sidebar">
    
        <ul class="nav ">
                @foreach($doctors as $doctor)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('appointments', ['doctors' => $doctor->id, 'day' => request('day')]) }}">
                    {{$doctor->first_name }}   {{$doctor->last_name }}</span>
                </a>
            </li>
            @endforeach
            
        </ul> 
    </nav>
    
@endsection
@section('scripts')
    <script>
       

     Echo.private('App.User.1')
    .listen('AppointmentCreated', (notification) => {
        console.log(notification.appointment);
        $('[hour="'+notification.appointment.hour+'"]').html(
            '<div style="height:100%;" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." class="used-slot"></div>'+
            '<span class="appointment-slot">Gabi Brosteanu</span>'
        )
    });
    </script>
@endsection


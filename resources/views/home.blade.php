@extends('adminlte::page')

@section('title', 'Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Website Dikerba</h1>
    <h5 style="color:green">Instalasi Diklat dan Litbang Rumah Sakit Ernaldi Bahar</h5>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

                    <h3>Kalender Kegiatan Pelatihan</h3>

                    <div id='calendar' style="width: auto"></div>

                </div>
            </div>
            <div style="position: center">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="btn btn-info btn-xs" href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="btn btn-info btn-xs" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="btn btn-info btn-xs" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            </div>
        </div>
    </div>
@stop
@push ('js')
<!-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<link href='fullcalendar/main.css' rel='stylesheet' />
<script src='fullcalendar/main.js'></script>
<script>
        $('#calendar').fullCalendar({
            timezone: 'Asia/Jakarta',
            // editable: true,
            // selectable: true,
            // header:{
            //     left: 'prev,next today',
            //     center:'title',
            //     right:'month,agendaWeek,agendaDay'
            // },
            eventColor: 'red',
            nextDayThreshold: '00:00',
            events : [
                @foreach($iht as $iht)
                {
                        title : '{{ $iht->jenis_kegiatan}}',
                        description : '{{$iht->nama_pelatihan}}',
                        start : moment('{{ $iht->tgl_mulai }}').format('YYYY-MM-DD'),
                        end : moment('{{ $iht->tgl_selesai }}').add(1, 'days').format('YYYY-MM-DD'),
                        @if($iht->jenis_kegiatan=="Pelatihan")
                            color:'green',
                        @elseif($iht->jenis_kegiatan=="IHT")
                            color:'purple',
                        @elseif($iht->jenis_kegiatan=="Seminar")
                            color:'blue',
                        @endif
                        url : '/iht/{{$iht -> id}}'
                        // url : '/iht'
                },
                @endforeach
            ],
            eventRender: function(event, element) {
            element.find('.fc-title').append("<br/>" + event.description);
            }
        });
</script>

@endpush

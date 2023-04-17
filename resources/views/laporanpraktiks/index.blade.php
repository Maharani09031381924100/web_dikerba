@extends('adminlte::page')

@section('title', 'Laporan Mahasiswa Praktik | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Laporan Data Mahasiswa Praktik</h1>
@stop

@section('content')
<!-- Modal Excel-->
<div class="modal fade" id="excelModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="excelModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excelModalLabel">Download Laporan Excel Laporan Mahasiswa Praktik</h5>
            </div>
            <div class="modal-body">
                <form method="get" action="/excelLaporan">
                   <div class="mb-3">
                       <label for="startdate" class="form-label">Tanggal Mulai</label>
                       <input type="date"class="date_range_filter date"   name="startdate"/>
                   </div>
                   <div class="mb-3">
                       <label for="enddate" class="form-label">Tanggal Selesai</label>
                       <input type="date" class="date_range_filter date"  name="enddate"/>
                   </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="download" class="btn btn-primary">Download</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('cetaklaporanpraktik') }}" method="post">
                        @csrf

                        <a class="btn btn-primary" href="{{ route('laporanpraktiks.create') }}"> Tambah</a>
                        @foreach ($laporanpraktiks as $laporanpraktik)
                        <input type="text" name="laporanpraktiks[]" value="{{ $laporanpraktik->id }}" hidden>
                        @endforeach

                        <button class="btn btn-danger" type="submit" formtarget="_blank">PDF</button>
                        <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#excelModal">
                            <i class="far fa-fw fa-file"></i> EXCEL
                        </button>
                    </form>
                    <br>
                    <form action="{{ route('laporanpraktiks.index') }}" method="GET">
                        &nbsp; <span  class="date-label">From: </span><input class="date_range_filter date" type="date"  name="start_date"/>
                        &nbsp; <span  class="date-label">To: <input class="date_range_filter date" type="date" name="end_date" />

                        <button class="btn btn-primary btn-xs" type="submit">submit</button>
                    </form>
                    <br><br>
                    <table class="table table-hover table-bordered table-stripped table-responsive" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Instansi</th>
                            <th>Fakultas</th>
                            <th>Jurusan</th>
                            <th>Program Studi</th>
                            <th>Tingkat Pendidikan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Kelulusan</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($laporanpraktiks as $key => $laporanpraktik)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $laporanpraktik->univ->univ_name }}</td>
                                <td>{{ $laporanpraktik->fakul->fakul_name }}</td>
                                <td>{{ $laporanpraktik->jurusan->jurusan_name }}</td>
                                <td>{{ $laporanpraktik->prodi->prodi_name }}</td>
                                <td>{{ $laporanpraktik->tingkatpendidikan->tkpendidikan_name }}</td>
                                <td>{{ date('d M Y', strtotime($laporanpraktik->tgl_mulai)) }}</td>
                                <td>{{ date('d M Y', strtotime($laporanpraktik->tgl_selesai)) }}</td>
                                <td>{{ $laporanpraktik->jumlah }}</td>
                                <td>{{ $laporanpraktik->keterangan }}</td>
                                <td>{{ $laporanpraktik->Kelulusan }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($laporanpraktik->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($laporanpraktik->updated_at)) }}</td>
                                @endif
                                <td>
                                <a class="btn btn-primary btn-xs" href="{{ route('laporanpraktiks.edit',$laporanpraktik->id) }}">Edit</a>
                                <a href="{{route('laporanpraktiks.destroy', $laporanpraktik->id)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    Delete
                                </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br><br>

<!-- PIE CHART -->
<div class="card card-danger">
    <div class="card-header">
      <h3 class="card-title">Pie Chart</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Bar Chart</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>
        </div>
    </div>
@stop



@push('js')

<!-- Bootstrap 4 -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="vendor/chart.js/Chart.min.js"></script>

    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        var table=$('#example2').DataTable({
            "responsive": true,
        });
        //fixed number first column
        table.on('order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
        table.cell(cell).invalidate('dom');//generate to pdf/excel
         } );
            } ).draw();
        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

     /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData        = {
        labels: [
            @foreach ($laporanpraktiks as $laporanpraktik )
                '{{ $laporanpraktik->univ->univ_name }}',
            @endforeach
        ],
        datasets: [
          {
            data: [
                @foreach ($laporanpraktiks as $laporanpraktik )
                {{ $laporanpraktik->jumlah }},
            @endforeach
            ],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#F08080', '#2F4F4F', '#556B2F', '#7FFFD4', '#5F9EA0', '#8A2BE2', '#FFE4C4', '#3c8dbc', '#0000FF', '#d2d6de'],
          }
        ]
      }
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })

      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = {
      labels  : [
        @foreach ($laporanpraktiks as $laporanpraktik )
                '{{ $laporanpraktik->univ->univ_name }}',
            @endforeach
      ],
      datasets: [
        {
            data: [
                @foreach ($laporanpraktiks as $laporanpraktik )
                {{ $laporanpraktik->jumlah }},
            @endforeach
            ],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#F08080', '#2F4F4F', '#556B2F', '#7FFFD4', '#5F9EA0', '#8A2BE2', '#FFE4C4', '#3c8dbc', '#0000FF', '#d2d6de'],
          }
      ]
    }

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        legend:{
            display: false
        },
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })
    </script>
@endpush

@extends('adminlte::page')

@section('title', 'Daftar JPL Pegawai | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar JPL Pegawai</h1>
@stop

@section('content')
@push('scripts')
{{-- <script type="text/javascript" src="{{ URL::asset('js/tna.js') }}"></script> --}}
@endpush
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="/jpls/{{$jplUtama['id']}}/create" class="btn btn-success my-2">
                    <i class="fa fa-plus"></i> Tambah Data JPL
                </a>
                <a href="/cetakJpl/{{$jplUtama['id']}}" class="btn btn-danger my-2">
                    <i class="far fa-fw fa-file"></i> PDF
                </a>
                <a href="/excelJpl/{{$jplUtama['id']}}" class="btn btn-success my-2">
                    <i class="far fa-fw fa-file"></i> EXCEL
                </a>
                <br>
                <br>
                <table class="table table-hover table-bordered table-stripped " id="jplTable">
                    <thead>
                        <tr>
                            <th style="width: 40px">No.</th>
                            <th>Nama Pegawai</th>
                            <th>Total JPL</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jpl as $jpl)
                            <tr>
                                <th scope="row"></th>
                                <td>{{$jpl->pegawai->nama_pegawai}}</td>
                                <td>
                                <?php
                                    $total_jpl = DB::table('jpls')->where(('jpl_id'),'=',($jplUtama['id']))->where('pegawai_id', $jpl['pegawai_id'])->sum('jpl');
                                    echo $total_jpl;
                                ?>
                                </td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($jpl->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($jpl->updated_at)) }}</td>
                                @endif
                                <td>
                                    <a href="/jpls/{{$jplUtama['id']}}/{{$jpl['pegawai_id']}}" class="btn btn-info btn-sm" style="margin: 3px 1px;">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>

                </p>
            </div>
        </div>
    </div>
</div>
@stack('scripts')
@stop
@push('js')
    <script type="text/javascript">
        //peserta
            var table1=$('#jplTable').DataTable({
                "columnDefs": [
                    {
                    "orderable": false,
                    "targets": [0,3]
                } //disable first and last column sorting
                ],
            });
            //fixed number first column
            table1.on( 'order.dt search.dt', function () {
                table1.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                    table1.cell(cell).invalidate('dom');//generate to pdf/excel
                } );
             } ).draw();
    </script>
@endpush

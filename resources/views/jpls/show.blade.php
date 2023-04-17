@extends('adminlte::page')

@section('title', 'Detail Data JPL Pegawai | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Detail JPL Pegawai</h1>
@stop

@section('content')
@push('scripts')

@endpush
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="/cetakDetail/{{$jplUtama['id']}}/{{$jpl['pegawai_id']}}" class="btn btn-danger my-2">
                    <i class="far fa-fw fa-file"></i> PDF
                </a>
                <a href="/excelDetailJpl/{{$jplUtama['id']}}/{{$jpl['pegawai_id']}}" class="btn btn-success my-2">
                    <i class="far fa-fw fa-file"></i> EXCEL
                </a>
                <table class="table table-hover table-bordered table-stripped table-responsive" id="jplTable" >
                    <thead>
                        <tr>
                            <th style="width: 40px">No.</th>
                            <th >Nama Pegawai</th>
                            <th >Kategori</th>
                            <th >Nama Kegiatan</th>
                            <th >Tempat</th>
                            <th >Tanggal Mulai</th>
                            <th >Tanggal Selesai</th>
                            <th >JPL</th>
                            <th >No Sertifikat</th>
                            <th >Penerbit Sertifikat</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jpls as $jpl)
                            <tr>
                                <th scope="row"></th>
                                <td>{{$jpl->pegawai->nama_pegawai}}</td>
                                <td>{{$jpl->kategori}}</td>
                                <td>{{$jpl->nama_kegiatan}}</td>
                                <td>{{$jpl->tempat}}</td>
                                <td>{{$jpl->tgl_mulai->format('d/m/Y')}}</td>
                                <td>{{$jpl->tgl_selesai->format('d/m/Y')}}</td>
                                <td>{{$jpl->jpl}}</td>
                                <td>{{$jpl->no_sertif}}</td>
                                <td>{{$jpl->penerbit}}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($jpl->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($jpl->updated_at)) }}</td>
                                @endif
                                <td>
                                    <a href="/jpls/{{$jplUtama['id']}}/edit/{{$jpl['id']}}" class="btn btn-success btn-sm" style="margin: 3px 1px;">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <form action="/jpls/{{$jplUtama['id']}}/destroy/{{$jpl['id']}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin: 3px 1px;" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                                    "targets": [0,9]
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

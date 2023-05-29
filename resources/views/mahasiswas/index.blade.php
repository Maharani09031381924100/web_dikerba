@extends('adminlte::page')

@section('title', 'Data Mahasiswa Praktik | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Data Mahasiswa Praktik</h1>
@stop

@section('content')
<!-- Modal Excel-->
<div class="modal fade" id="excelModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="excelModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excelModalLabel">Download Laporan Excel Daftar Mahasiswa</h5>
            </div>
            <div class="modal-body">
                <form method="get" action="/excelMahasiswa">
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

                    <a class="btn btn-primary" href="{{ route('mahasiswas.create') }}">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                    <a class="btn btn-danger" href="{{ route('cetakmahasiswa') }}" target="_blank"><i class="far fa-fw fa-file"></i> PDF</a>
                    <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#excelModal">
                        <i class="far fa-fw fa-file"></i> EXCEL
                    </button>
                    <br><br>

                    <table class="table table-hover table-bordered table-stripped table-responsive" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Instansi</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Ruangan</th>
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
                        @foreach($data as $key => $mahasiswa)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $mahasiswa->univ_name }}</td>
                                <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                                <td>{{ date('d M Y', strtotime($mahasiswa->tgl_mulai)) }}</td>
                                <td>{{ date('d M Y', strtotime($mahasiswa->tgl_selesai)) }}</td>
                                <td>{{ $mahasiswa->ruangan_name }}</td>
                                <td>{{ $mahasiswa->keterangan }}</td>
                                <td>{{ $mahasiswa->Kelulusan }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($mahasiswa->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($mahasiswa->updated_at)) }}</td>
                                @endif
                                <td>
                                <a class="btn btn-info btn-xs" href="{{ route('mahasiswas.show',$mahasiswa->id) }}">Show</a>
                                <a class="btn btn-primary btn-xs" href="{{ route('mahasiswas.edit',$mahasiswa->id) }}">Edit</a>
                                <a href="{{route('mahasiswas.destroy', $mahasiswa->id)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    Delete
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
@stop

@push('js')
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

    </script>
@endpush




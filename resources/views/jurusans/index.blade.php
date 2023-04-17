@extends('adminlte::page')

@section('title', 'Daftar Jurusan | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Nama Jurusan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a class="btn btn-primary" href="{{ route('jurusans.create') }}"> Tambah</a>
                    <br><br>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jurusan</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jurusans as $key => $jurusan)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $jurusan->jurusan_name }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($jurusan->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($jurusan->updated_at)) }}</td>
                                @endif
                                <td>
                                <a href="{{ route('jurusans.edit', $jurusan->idjurusan) }}" class="btn btn-primary btn-xs">Edit</a>
                                <a href="{{route('jurusans.destroy', $jurusan->idjurusan)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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




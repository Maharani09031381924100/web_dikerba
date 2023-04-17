@extends('adminlte::page')

@section('title', 'Daftar Tingkat Pendidikan | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Nama Tingkat Pendidikan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a class="btn btn-primary" href="{{ route('tingkatpendidikans.create') }}"> Tambah</a>
                    <br><br>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tingkat Pendidikan</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tingkatpendidikans as $key => $tingkatpendidikan)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $tingkatpendidikan->tkpendidikan_name }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($tingkatpendidikan->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($tingkatpendidikan->updated_at)) }}</td>
                                @endif
                                <td>
                                <a href="{{ route('tingkatpendidikans.edit', $tingkatpendidikan->idtkpendidikan) }}" class="btn btn-primary btn-xs">Edit</a>
                                <a href="{{route('tingkatpendidikans.destroy', $tingkatpendidikan->idtkpendidikan)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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




@extends('adminlte::page')

@section('title', 'Daftar Ruangan | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Nama Ruangan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a class="btn btn-primary" href="{{ route('ruangans.create') }}"> Tambah</a>
                    <br><br>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Ruangan</th>
                            <th>Nama Ruangan</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ruangans as $key => $ruangan)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $ruangan->kode }}</td>
                                <td>{{ $ruangan->ruangan_name }}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($ruangan->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($ruangan->updated_at)) }}</td>
                                @endif
                                <td>
                                </a>
                                <a href="{{ route('ruangans.edit', $ruangan->idruangan) }}" class="btn btn-primary btn-xs">Edit</a>
                                <a href="{{route('ruangans.destroy', $ruangan->idruangan)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush




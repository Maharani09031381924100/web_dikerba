@extends('adminlte::page')

@section('title', 'Data Akun User | Wesite Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Data Akun User</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('users.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($user->created_at)) }}</td>
                                <td>{{ date('d M Y', strtotime($user->created_at)) }}</td>
                                @endif
                                <td>
                                    <a href="{{route('users.edit', $user)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{route('users.destroy', $user)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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

@extends('adminlte::page')

@section('title', 'Kuesioner Evaluasi Dokter Pendidik | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Kuesioner Evaluasi Dokter Pendidik Klinis</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
            <form action="{{route('uploadevaluasidokterpendidik.store')}}" method="post" enctype="multipart/form-data">
        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Input File</label>
                                <input type="file" class="form-control" id="nama" name="file">
                            </div>
                            {{-- pesan error  --}}
                            @error('file')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="exampleInputPassword1">Keterangan</label>
                                <textarea name="keterangan" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            {{-- pesan error  --}}
                            @error('keterangan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" id="tombol-simpan" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                <div class="card-body">

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                        <th>No</th>
                            <th>File</th>
                            <th width="25%">Download</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($data as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if( in_array(pathinfo($item->file, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG']))
                                    <img src="{{asset('file_uploadevaluasidokterpendidik')}}/{{$item->file}}" style="height: 40px">
                                @else
                                    <img src="https://www.freeiconspng.com/uploads/file-txt-icon--icon-search-engine--iconfinder-14.png"
                                    style="height: 40px">
                                @endif
                            </td>
                            <td align="center"><a href="{{asset('file_uploadevaluasidokterpendidik')}}/{{$item->file}}" download>Download</a></td>
                            <td>{{$item->keterangan}}</td>
                            <td>
                                <a href="{{route('uploadevaluasidokterpendidik.destroy',$item->id)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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


@extends('adminlte::page')

@section('title', 'Daftar Tahun Data TNA | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Tahun Training Need Analysis</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{route('tnas.createUtama')}}" class="btn btn-primary mb-2" style="float: left;">
                    <i class="fa fa-plus"></i> Tambah
                </a>
                <br>
                <br>
                <table class="table table-hover table-bordered table-stripped" id="tnaUtamaTable" >
                    <thead>
                        <tr>
                            <th >No.</th>
                            <th>Tahun</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tnas as $tnaUtama)
                            <tr>
                                <th scope="row"></th>
                                <td>{{$tnaUtama->tahun}}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($tnaUtama->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($tnaUtama->updated_at)) }}</td>
                                @endif
                                <td>
                                    <a href="{{route('tnas.editUtama', $tnaUtama['id'])}}" class="btn btn-success btn-sm" style="margin: 3px 1px;">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <form action="{{route('tnas.destroyUtama' , $tnaUtama['id'])}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin: 3px 1px;" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a href="{{route('tnas.show', $tnaUtama['id'])}}" class="btn btn-info btn-sm" style="margin: 3px 1px;">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
            </script>
            </div>
        </div>
    </div>
</div>
@stack('scripts')
@stop
@push('js')
    <script>
        var table=$('#tnaUtamaTable').DataTable({
        "columnDefs": [
            { "searchable": false,
              "orderable": false,
              "targets": [0,2]
            } //disable first and last column sorting
        ],
    });
    //fixed number first column
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table.cell(cell).invalidate('dom');//generate to pdf/excel
        } );
    } ).draw();
    </script>
@endpush


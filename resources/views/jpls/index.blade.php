@extends('adminlte::page')

@section('title', 'Daftar Data Tahun JPL | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Tahun JPL</h1>
@stop

@section('content')
@push('scripts')
{{-- <script type="text/javascript" src="{{ URL::asset('js/tna.js') }}"></script> --}}
@endpush
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{route('jpls.createUtama')}}" class="btn btn-primary mb-2">
                    <i class="fa fa-plus"></i> Tambah Data JPL
                </a>
                <br><br>
                <table class="table table-hover table-bordered table-stripped" id="jplTable" >
                    <thead>
                        <tr>
                            <th style="width: 40px">No.</th>
                            <th>Tahun</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jpls as $jplUtama)
                            <tr>
                                <th scope="row"></th>
                                <td>{{$jplUtama->tahun}}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($jplUtama->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($jplUtama->updated_at)) }}</td>
                                @endif
                                <td>
                                    <a href="{{route('jpls.editUtama', $jplUtama['id'])}}" class="btn btn-success btn-sm" style="margin: 3px 1px;">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <form action="{{route('jpls.destroyUtama' , $jplUtama['id'])}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin: 3px 1px;" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a href="{{route('jpls.showDetail', $jplUtama['id'])}}" class="btn btn-info btn-sm" style="margin: 3px 1px;">
                                        <i class="fa fa-info" aria-hidden="true"></i>
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
@stack('scripts')
@stop
@push('js')
<script type="text/javascript">
        //peserta
        var table1=$('#jplTable').DataTable({
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [0,2]
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

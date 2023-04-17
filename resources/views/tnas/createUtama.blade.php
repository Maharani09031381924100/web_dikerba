@extends('adminlte::page')

@section('title', 'Tambah TNA')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data TNA</h1>
@stop

@section('content')
    <form action="{{route('tnas.storeUtama')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="periode">Tahun</label>
                            <select name="tahun" class="form-control @error('tahun') is-invalid @enderror" id="tahun">
                            </select>
                            @error('tahun') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{route('tnas.index')}}" class="btn btn-default">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <script>
        //select box input
        var max = new Date().getFullYear(),
        min = max - 99,
        select = document.getElementById('tahun');
        for (var i = max; i >= min; i--) {
          var opt = document.createElement('option');
          opt.value = i;
          opt.innerHTML = i;
          select.appendChild(opt);
        }
    </script>
@stop

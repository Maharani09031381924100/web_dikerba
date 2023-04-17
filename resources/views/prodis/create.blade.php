@extends('adminlte::page')

@section('title', 'Tambah Data Program Studi | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Program Studi</h1>
@stop

@section('content')
    <form action="{{route('prodis.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama Program Studi</label>
                        <input type="text" class="form-control @error('prodi_name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Program Studi" name="prodi_name" value="{{old('prodi_name')}}">
                        @error('prodi_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('prodis.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

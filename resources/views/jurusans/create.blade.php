@extends('adminlte::page')

@section('title', 'Tambah Data Jurusan | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Jurusan</h1>
@stop

@section('content')
    <form action="{{route('jurusans.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama Jurusan</label>
                        <input type="text" class="form-control @error('jurusan_name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Jurusan" name="jurusan_name" value="{{old('jurusan_name')}}">
                        @error('jurusan_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('jurusans.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

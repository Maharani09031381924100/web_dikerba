@extends('adminlte::page')

@section('title', 'Tambah Data Ruangan | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Ruangan</h1>
@stop

@section('content')
    <form action="{{route('ruangans.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Kode Ruangan</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="exampleInputName" placeholder="Kode Ruangan" name="kode" value="{{old('kode')}}">
                        @error('kode') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('ruangan_name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Ruangan" name="ruangan_name" value="{{old('ruangan_name')}}">
                        @error('ruangan_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('ruangans.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

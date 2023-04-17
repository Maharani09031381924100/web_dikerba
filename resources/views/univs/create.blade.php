@extends('adminlte::page')

@section('title', 'Tambah Data Instansi | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Instansi</h1>
@stop

@section('content')
    <form action="{{route('univs.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama Instansi</label>
                        <input type="text" class="form-control @error('univ_name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Universitas" name="univ_name" value="{{old('univ_name')}}">
                        @error('univ_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('univs.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('adminlte::page')

@section('title', 'Tambah Data Fakultas | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Create Fakultas</h1>
@stop

@section('content')
    <form action="{{route('fakuls.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama Fakultas</label>
                        <input type="text" class="form-control @error('fakul_name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Fakultas" name="fakul_name" value="{{old('fakul_name')}}">
                        @error('fakul_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('fakuls.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

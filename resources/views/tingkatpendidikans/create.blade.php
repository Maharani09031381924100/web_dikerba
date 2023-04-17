@extends('adminlte::page')

@section('title', 'Tambah Data Tingkat Pendidikan | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Tingkat Pendidikan</h1>
@stop

@section('content')
    <form action="{{route('tingkatpendidikans.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama Tingkat Pendidikan</label>
                        <input type="text" class="form-control @error('tkpendidikan_name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Tingkat Pendidikan" name="tkpendidikan_name" value="{{old('tkpendidikan_name')}}">
                        @error('tkpendidikan_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('tingkatpendidikans.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

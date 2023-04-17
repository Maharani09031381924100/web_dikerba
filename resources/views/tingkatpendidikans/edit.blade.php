@extends('adminlte::page')

@section('title', 'Edit Data Tingkat Pendidikan | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Tingkat Pendidikan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">

                </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tingkatpendidikans.update',$tingkatpendidikan->idtkpendidikan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nama Tingkat Pendidikan:</strong>
                                    <input type="text" name="tkpendidikan_name" value="{{ $tingkatpendidikan->tkpendidikan_name }}" class="form-control" placeholder="Nama Tingkat Pendidikan">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('tingkatpendidikans.index')}}" class="btn btn-default">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

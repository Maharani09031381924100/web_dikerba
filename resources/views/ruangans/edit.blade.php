@extends('adminlte::page')

@section('title', 'Edit Data Ruangan | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Ruangan</h1>
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

                    <form action="{{ route('ruangans.update',$ruangan->idruangan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Kode</strong>
                                    <input type="text" name="kode" value="{{ $ruangan->kode }}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Ruangan</strong>
                                    <input type="text" name="ruangan_name" value="{{ $ruangan->ruangan_name }}" class="form-control" placeholder="Ruangan">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('ruangans.index')}}" class="btn btn-default">
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

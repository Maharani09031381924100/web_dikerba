@extends('adminlte::page')

@section('title', 'Tambah Data Orientasi Pegawai | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Orientasi Pegawai</h1>
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

                <form action="{{ route('orientasis.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name</strong>
                                <input type="text" name="name" class="form-control" placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Jenis Kelamin</strong>
                                <select type="text" name="jk" class="form-control" placeholder="Jenis Kelamin">
                                <option value=''>Jenis  Kelamin</option>
                                <option value='Laki-laki'>Laki-laki</option>
                                <option value='Perempuan'>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Tanggal Mulai</strong>
                                <input type="date" name="tgl_orientasi" class="form-control" placeholder="Tanggal Mulai">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Tanggal Selesai</strong>
                                <input type="date" name="tgl_selesaiorientasi" class="form-control" placeholder="Tanggal Selesai">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Status Pegawai</strong>
                                <input type="text" name="status_pegawai" class="form-control" placeholder="Status Pegawai">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Tingkat Pendidikan</strong>
                                <input type="text" name="pendidikan" class="form-control" placeholder="Tingkat Pendidikan">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Asal Tempat Kerja</strong>
                                <input type="text" name="asal" class="form-control" placeholder="Asal Tempat Kerja">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('orientasis.index')}}" class="btn btn-default">
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

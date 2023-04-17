@extends('adminlte::page')

@section('title', 'Detail Data Mahasiswa Praktik | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Data Mahasiswa Praktik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Nama Lengkap:</strong>
                                {{ $mahasiswa->nama_mahasiswa }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>NIM:</strong>
                                {{ $mahasiswa->nim }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Jenis Kelamin:</strong>
                                {{ $mahasiswa->jk }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Instansi:</strong>
                                {{ $mahasiswa->univ->univ_name }}

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Fakultas:</strong>
                                {{ $mahasiswa->fakul->fakul_name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Jurusan:</strong>
                                {{ $mahasiswa->jurusan->jurusan_name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Program Studi:</strong>
                                {{ $mahasiswa->prodi->prodi_name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Tingkat Pendidikan:</strong>
                                {{ $mahasiswa->tingkatpendidikan->tkpendidikan_name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Semester:</strong>
                                {{ $mahasiswa->semester }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Tanggal Masuk:</strong>
                                {{ $mahasiswa->tgl_mulai }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Tanggal Keluar:</strong>
                                {{ $mahasiswa->tgl_selesai }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Ruangan:</strong>
                                {{ $mahasiswa->ruangan->ruangan_name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Keterangan:</strong>
                                {{ $mahasiswa->keterangan }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="list-group-item">
                                <strong>Status Kelulusan:</strong>
                                {{ $mahasiswa->Kelulusan }}
                            </div>
                        </div>
                    </div>
                <br>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{ route('mahasiswas.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>
@stop

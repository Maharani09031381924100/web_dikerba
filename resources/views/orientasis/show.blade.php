@extends('adminlte::page')

@section('title', 'Detail Orientasi Pegawai | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Orientasi Pegawai</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="list-group-item">
                        <strong>Name:</strong>
                        {{ $orientasi->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="list-group-item">
                        <strong>Jenis Kelamin:</strong>
                        {{ $orientasi->jk }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="list-group-item">
                        <strong>Tgl Mulai:</strong>
                        {{ date('d M Y', strtotime($orientasi->tgl_orientasi)) }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="list-group-item">
                        <strong>Tgl Selesai:</strong>
                        {{ date('d M Y', strtotime($orientasi->tgl_selesaiorientasi)) }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="list-group-item">
                        <strong>Status Pegawai:</strong>
                        {{ $orientasi->status_pegawai }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="list-group-item">
                        <strong>Pendidikan:</strong>
                        {{ $orientasi->pendidikan }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="list-group-item">
                        <strong>Asal Tempat Kerja:</strong>
                        {{ $orientasi->asal }}
                    </div>
                </div>
                </div></br>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{ route('orientasis.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>
@stop

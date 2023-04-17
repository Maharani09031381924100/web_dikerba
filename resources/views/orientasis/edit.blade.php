@extends('adminlte::page')

@section('title', 'Edit Data Orientasi Pegawai | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Orientasi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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

                    <form action="{{ route('orientasis.update',$orientasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" value="{{ $orientasi->name }}" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Jenis Kelamin:</strong>
                                    <select type="text" name="jk" class="form-control" placeholder="Jenis Kelamin">

                                    <?php if ($orientasi->jk =='Laki-laki'): ?>
                                            <Option value='Laki-laki' selected>Laki-laki</option>
                                            <Option value='Perempuan'>Perempuan</option>
                                    <?php else: ?>
                                            <Option value='Perempuan' selected>Perempuan</option>
                                            <Option value='Laki-laki'>Laki-laki</option>
                                    <?php endif?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal Mulai:</strong>
                                    <input type="date" name="tgl_orientasi" value="{{ $orientasi->tgl_orientasi }}" class="form-control" placeholder="Tanggal Mulai">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal Selesai:</strong>
                                    <input type="date" name="tgl_selesaiorientasi" value="{{ $orientasi->tgl_selesaiorientasi }}" class="form-control" placeholder="Tanggal Selesai">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status Pegawai:</strong>
                                    <input type="text" name="status_pegawai" value="{{ $orientasi->status_pegawai }}" class="form-control" placeholder="Status Pegawai">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tingkat Pendidikan:</strong>
                                    <input type="text" name="pendidikan" value="{{ $orientasi->pendidikan }}" class="form-control" placeholder="Tingkat Pendidikan">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Asal Tempat Kerja:</strong>
                                    <input type="text" name="asal" value="{{ $orientasi->asal }}" class="form-control" placeholder="Asal Tempat Berkerja">
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

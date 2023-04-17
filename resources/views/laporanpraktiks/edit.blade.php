@extends('adminlte::page')

@section('title', 'Edit Laporan Mahasiswa Praktik | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Laporan Praktik</h1>
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

                    <form action="{{ route('laporanpraktiks.update',$laporanpraktik->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Instansi</strong>
                                    <select type="text" name="univ_id" class="form-control" placeholder="Instansi">
                                            @foreach ($univs as $univ)
                                            <option value="{{ $univ->iduniv }}" @selected($laporanpraktik->univ_id==$univ->iduniv)>{{ $univ->univ_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Fakultas</strong>
                                    <select type="text" name="fakul_id" class="form-control" placeholder="Fakultas">
                                        @foreach ($fakuls as $fakul)
                                        <option value="{{ $fakul->idfakul }}" @selected($laporanpraktik->fakul_id==$fakul->idfakul)>{{ $fakul->fakul_name }}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Jurusan</strong>
                                    <select type="text" name="jurusan_id" class="form-control" placeholder="Jurusan">
                                        @foreach ($jurusans as $jurusan)
                                        <option value="{{ $jurusan->idjurusan }}" @selected($laporanpraktik->jurusan_id==$jurusan->idjurusan)>{{ $jurusan->jurusan_name }}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Program Studi</strong>
                                    <select type="text" name="prodi_id" class="form-control" placeholder="Program Studi">
                                        @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->idprodi }}" @selected($laporanpraktik->prodi_id==$prodi->idprodi)>{{ $prodi->prodi_name }}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tingkat Pendidikan</strong>
                                    <select type="text" name="tkpendidikan_id" class="form-control" placeholder="Tingkat Pendidikan">
                                        @foreach ($tingkatpendidikans as $tingkatpendidikan)
                                        <option value="{{ $tingkatpendidikan->idtkpendidikan }}" @selected($laporanpraktik->tkpendidikan_id==$tingkatpendidikan->idtkpendidikan)>{{ $tingkatpendidikan->tkpendidikan_name }}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal Masuk:</strong>
                                    <input type="date" name="tgl_mulai" value="{{ $laporanpraktik->tgl_mulai }}" class="form-control" placeholder="Tanggal Masuk">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal Keluar:</strong>
                                    <input type="date" name="tgl_selesai" value="{{ $laporanpraktik->tgl_selesai }}" class="form-control" placeholder="Tanggal Keluar">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Jumlah</strong>
                                    <input type="integer" name="jumlah" value="{{ $laporanpraktik->jumlah }}" class="form-control" placeholder="Jumlah Mahasiswa">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Keterangan</strong>
                                    <input type="text" name="keterangan" value="{{ $laporanpraktik->keterangan }}" class="form-control" placeholder="Keterangan">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status Kelulusan</strong>
                                    <select type="text" name="Kelulusan" class="form-control" placeholder="Kelulusan">

                                    <?php if ($laporanpraktik->Kelulusan =='Belum Lulus'): ?>
                                            <option value='Belum Lulus' selected>Belum Lulus</option>
                                            <option value='Lulus'>Lulus</option>
                                            <option value='Tidak Lulus'>Tidak Lulus</option>
                                    <?php elseif($laporanpraktik->Kelulusan =='Lulus'): ?>
                                            <option value='Belum Lulus'>Belum Lulus</option>
                                            <option value='Lulus'selected>Lulus</option>
                                            <option value='Tidak Lulus'>Tidak Lulus</option>
                                    <?php else: ?>
                                        <option value='Belum Lulus'>Belum Lulus</option>
                                        <option value='Lulus'>Lulus</option>
                                        <option value='Tidak Lulus'selected>Tidak Lulus</option>
                                    <?php endif?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('laporanpraktiks.index')}}" class="btn btn-default">
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

@extends('adminlte::page')

@section('title', 'Daftar Detail TNA | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Detail TNA</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{route('tnas.createTna', $tnaUtama['id'])}}" class="btn btn-primary my-2">
                    <i class="fa fa-plus"></i> Tambah Data TNA
                </a>
                <a href="/cetakTna/{{$tnaUtama['id']}}" class="btn btn-danger my-2">
                    <i class="far fa-fw fa-file"></i> PDF
                </a>
                <a href="/excelTna/{{$tnaUtama['id']}}" class="btn btn-success my-2">
                    <i class="far fa-fw fa-file"></i> EXCEL
                </a>
                <table class="table table-hover table-bordered table-stripped table-responsive" id="tnaTable">
                    <thead>
                        <tr>
                            <th width="50px">No.</th>
                            <th width="100px">Email</th>
                            <th width="100px">Nama</th>
                            <th width="100px">Umur</th>
                            <th width="100px">Jenis Kelamin</th>
                            <th width="100px">Tingkat Pendidikan</th>
                            <th width="100px">Status Pekerjaan</th>
                            <th width="100px">Status Jabatan</th>
                            <th width="100px">Lama Bekerja di Rumah Sakit</th>
                            <th width="100px">Lama Bekerja di Tempat Sekarang</th>
                            <th width="100px">Bidang/Bagian Tempat Bekerja</th>
                            <th width="200px">Kompetensi yang wajib dimiliki berdasarkan Tupoksi</th>
                            <th width="200px">Masalah yang dihadapi untuk pengembangan capaian kompetensi (diisi berdasarkan poin sebelumnya)</th>
                            <th width="200px">Pelatihan/IHT/seminar/workshop/teknis yang telah diikuti dalam 2 tahun terakhir (online/offline)</th>
                            <th width="200px">Pelatihan/IHT/Prioritas untuk Pengembangan Kompetensi sesuai Tupoksi</th>
                            <th>Pendidikan</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tna as $tna)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$tna->pegawai->email_address}}</td>
                                <td>{{$tna->pegawai->nama_pegawai}}</td>
                                <td>{{$tna->umur}}</td>
                                <td>{{$tna->pegawai->jk}}</td>
                                <td>{{$tna->pegawai->tk_pddkan}}</td>
                                <td>{{$tna->pegawai->status_pekerjaan}}</td>
                                <td>{{$tna->pegawai->status_jabatan}}</td>
                                <td>{{$tna->lama_kerja_rs}}</td>
                                <td>{{$tna->lama_kerja_skrg}}</td>
                                <td>{{$tna->pegawai->bidang}}</td>
                                <td>{{$tna->kompetensi}}</td>
                                <td>{{$tna->masalah}}</td>
                                <td>{{$tna->pelatihan_2_thn}}</td>
                                <td>{{$tna->pelatihan_tupoksi}}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($tna->created_at)) }}</td>
                                @endif
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime ($tna->updated_at)) }}</td>
                                @endif
                                <td>
                                    <a href="/tnas/{{$tnaUtama['id']}}/edit/{{$tna['id']}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <form action="/tnas/{{$tnaUtama['id']}}/destroy/{{$tna['id']}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin: 3px 1px;" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

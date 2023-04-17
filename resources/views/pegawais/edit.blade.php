@extends('adminlte::page')

@section('title', 'Edit Data Pegawai | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Pegawai</h1>
@stop

@section('content')
    <form action="{{route('pegawais.update',$pegawai)}}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputNomor">Nomor Pegawai</label>
                            <input type="number" class="form-control @error('no_pegawai') is-invalid @enderror" id="exampleInputNomor" placeholder="Nomor Pegawai" name="no_pegawai" value="{{$pegawai->no_pegawai ?? old('no_pegawai')}}">
                            @error('no_pegawai') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email</label>
                            <input type="text" class="form-control @error('email_address') is-invalid @enderror" id="exampleInputEmail" placeholder="Alamat Email" name="email_address" value="{{$pegawai->email_address ?? old('email_address')}}">
                            @error('email_address') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNama">Nama Pegawai</label>
                            <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" id="exampleInputNama" placeholder="Nama Pegawai" name="nama_pegawai" value="{{$pegawai->nama_pegawai ?? old('nama_pegawai')}}">
                            @error('nama_pegawai') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputJenisKelamin">Jenis Kelamin</label>
                            <select type="text" class="form-control @error('jk') is-invalid @enderror" id="jk" name="jk">
                                <option disabled selected value>---Jenis Kelamin---</option>
                                <option value='L' {{old('jk', $pegawai->jk) == 'L' ? "selected" : ""}}>Laki-laki</option>
                                <option value='P' {{old('jk', $pegawai->jk) == 'P' ? "selected" : ""}}>Perempuan</option>
                            </select>
                            @error('jk') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTkPddkan">Tingkat Pendidikan</label>
                            <select type="text" class="form-control @error('tk_pddkan') is-invalid @enderror" id="tk_pddkan"  name="tk_pddkan">
                                <option disabled selected value>---Tingkat Pendidikan---</option>
                                <option value='D-I' {{old('tk_pddkan', $pegawai->tk_pddkan) == 'D-I' ? "selected" : ""}}>D-I</option>
                                <option value='D-II' {{old('tk_pddkan', $pegawai->tk_pddkan) == 'D-II' ? "selected" : ""}}>D-II</option>
                                <option value='D-III' {{old('tk_pddkan', $pegawai->tk_pddkan) == 'D-III' ? "selected" : ""}}>D-III</option>
                                <option value='D-IV' {{old('tk_pddkan', $pegawai->tk_pddkan) == 'D-IV' ? "selected" : ""}}>D-IV</option>
                                <option value='S1' {{old('tk_pddkan', $pegawai->tk_pddkan) == 'S1' ? "selected" : ""}}>S1</option>
                                <option value='S2' {{old('tk_pddkan', $pegawai->tk_pddkan) == 'S2' ? "selected" : ""}}>S2</option>
                                <option value='S3' {{old('tk_pddkan', $pegawai->tk_pddkan) == 'S3' ? "selected" : ""}}>S3</option>
                            </select>
                            @error('tk_pddkan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStatusPekerjaan">Status Pekerjaan</label>
                            <select type="text" class="form-control @error('status_pekerjaan') is-invalid @enderror" id="exampleInputStatusPekerjaan" name="status_pekerjaan">
                                <option disabled selected value>---Status Pekerjaan---</option>
                                <option value='PNS/ASN' {{old('status_pekerjaan', $pegawai->status_pekerjaan) == 'PNS/ASN' ? "selected" : ""}}>PNS/ASN</option>
                                <option value='Non PNS/ASN' {{old('status_pekerjaan', $pegawai->status_pekerjaan) == 'Non PNS/ASN' ? "selected" : ""}}>Non PNS/ASN</option>
                            </select>
                            @error('status_pekerjaan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStatusJabatan">Status Jabatan</label>
                            <input type="text" class="form-control @error('status_jabatan') is-invalid @enderror" id="exampleInputStatusJabatan" placeholder="Jabatan" name="status_jabatan" value="{{$pegawai->status_jabatan ?? old('status_jabatan')}}">
                            @error('status_jabatan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputBidang">Bidang</label>
                            <select type="text" class="form-control @error('bidang') is-invalid @enderror" id="exampleInputBidang"  name="bidang">
                                <option disabled selected value>---Bidang atau Bagian---</option>
                                <option value='Direktur' {{old('bidang', $pegawai->bidang) == 'Direktur' ? "selected" : ""}}>Direktur</option>
                                <option value='Wakil Direktur Umum dan Keuangan' {{old('bidang', $pegawai->bidang) == 'Wakil Direktur Umum dan Keuangan' ? "selected" : ""}}>Wakil Direktur Umum dan Keuangan</option>
                                <option value='Wakil Direktur Medik dan Keperawatan' {{old('bidang', $pegawai->bidang) == 'Wakil Direktur Medik dan Keperawatan' ? "selected" : ""}}>Wakil Direktur Medik dan Keperawatan</option>
                                <option value='Bagian Pengembangan' {{old('bidang', $pegawai->bidang) == 'Bagian Pengembangan' ? "selected" : ""}}>Bagian Pengembangan</option>
                                <option value='Bagian Keuangan' {{old('bidang', $pegawai->bidang) == 'Bagian Keuangan' ? "selected" : ""}}>Bagian Keuangan</option>
                                <option value='Bagian Umum dan SDM' {{old('bidang', $pegawai->bidang) == 'Bagian Umum dan SDM' ? "selected" : ""}}>Bagian Umum dan SDM</option>
                                <option value='Bidang Pelayanan Medik' {{old('bidang', $pegawai->bidang) == 'Bidang Pelayanan Medik' ? "selected" : ""}}>Bidang Pelayanan Medik</option>
                                <option value='Bidang Penunjang Medik' {{old('bidang', $pegawai->bidang) == 'Bidang Penunjang Medik' ? "selected" : ""}}>Bidang Penunjang Medik</option>
                                <option value='Bidang Keperawatan' {{old('bidang', $pegawai->bidang) == 'Bidang Keperawatan' ? "selected" : ""}}>Bidang Keperawatan</option>
                            </select>
                            @error('bidang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{route('pegawais.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

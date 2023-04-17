@extends('adminlte::page')

@section('title', 'Tambah Data JPL | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data JPL Pegawai</h1>
@stop

@section('content')
    <form action="{{route('jpls.store', $jplUtama['id'])}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Primary Key -->
                        <div class="form-group">
                            <label for="no_pegawai">Nomor Pegawai</label>
                            <input type="number" class="form-control @error('no_pegawai') is-invalid @enderror" id="no_pegawai" placeholder="Nomor Pegawai" name="no_pegawai" value="{{old('no_pegawai')}}">
                            @error('no_pegawai') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="jpl_id" value="{{ $jplUtama->id }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="pegawai_id" name="pegawai_id">
                        </div>
                        <!-- Pegawai -->
                        <div class="form-group">
                            <label for="email_address">Email</label>
                            <input type="text" class="form-control @error('email_address') is-invalid @enderror" id="email_address" placeholder="Alamat Email" name="email_address" value="{{old('email_address')}}" disabled>
                            @error('email_address') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai" placeholder="Nama Pegawai" name="nama_pegawai" value="{{old('nama_pegawai')}}" disabled>
                            @error('nama_pegawai') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select type="text" class="form-control @error('jk') is-invalid @enderror" id="jk"  name="jk" disabled>
                                <option value=''>---Jenis Kelamin---</option>
                                <option value='L' {{old('jk') == 'L' ? "selected" : ""}}>Laki-laki</option>
                                <option value='P' {{old('jk') == 'P' ? "selected" : ""}}>Perempuan</option>
                            </select>
                            @error('jk') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tk_pddkan">Tingkat Pendidikan</label>
                            <select type="text" class="form-control @error('tk_pddkan') is-invalid @enderror" id="tk_pddkan"  name="tk_pddkan" value="{{ old('tk_pddkan') }}" disabled>
                                <option value=''>---Tingkat Pendidikan---</option>
                                <option value='SMA' {{old('tk_pddkan') == 'SMA' ? "selected" : ""}}>SMA</option>
                                <option value='D-I' {{old('tk_pddkan') == 'D-I' ? "selected" : ""}}>D-I</option>
                                <option value='D-II' {{old('tk_pddkan') == 'D-II' ? "selected" : ""}}>D-II</option>
                                <option value='D-III' {{old('tk_pddkan') == 'D-III' ? "selected" : ""}}>D-III</option>
                                <option value='D-IV' {{old('tk_pddkan') == 'D-IV' ? "selected" : ""}}>D-IV</option>
                                <option value='S1' {{old('tk_pddkan') == 'S1' ? "selected" : ""}}>S1</option>
                                <option value='S2' {{old('tk_pddkan') == 'S2' ? "selected" : ""}}>S2</option>
                                <option value='S3' {{old('tk_pddkan') == 'S3' ? "selected" : ""}}>S3</option>
                                <option value='Lainnya' {{old('tk_pddkan') == 'Lainnya' ? "selected" : ""}}>Lainnya</option>
                            </select>
                            @error('tk_pddkan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_pekerjaan">Status Pekerjaan</label>
                            <input type="text" class="form-control @error('status_pekerjaan') is-invalid @enderror" id="status_pekerjaan" placeholder="Contoh: PNS/ASN" name="status_pekerjaan" value="{{old('status_pekerjaan')}}" disabled>
                            @error('status_pekerjaan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_jabatan">Status Jabatan</label>
                            <input type="text" class="form-control @error('status_jabatan') is-invalid @enderror" id="status_jabatan" placeholder="Jabatan" name="status_jabatan" value="{{old('status_jabatan')}}" disabled>
                            @error('status_jabatan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="bidang">Bidang</label>
                            <select type="text" class="form-control @error('bidang') is-invalid @enderror" id="bidang"  name="bidang" disabled>
                                <option value=''>---Bidang atau Bagian---</option>
                                <option value='Direktur' {{old('bidang') == 'Direktur' ? "selected" : ""}}>Direktur</option>
                                <option value='Wakil Direktur Umum dan Keuangan' {{old('bidang') == 'Wakil Direktur Umum dan Keuangan' ? "selected" : ""}}>Wakil Direktur Umum dan Keuangan</option>
                                <option value='Wakil Direktur Medik dan Keperawatan' {{old('bidang') == 'Wakil Direktur Medik dan Keperawatan' ? "selected" : ""}}>Wakil Direktur Medik dan Keperawatan</option>
                                <option value='Bagian Pengembangan' {{old('bidang') == 'Bagian Pengembangan' ? "selected" : ""}}>Bagian Pengembangan</option>
                                <option value='Bagian Keuangan' {{old('bidang') == 'Bagian Keuangan' ? "selected" : ""}}>Bagian Keuangan</option>
                                <option value='Bagian Umum dan SDM' {{old('bidang') == 'Bagian Umum dan SDM' ? "selected" : ""}}>Bagian Umum dan SDM</option>
                                <option value='Bidang Pelayanan Medik' {{old('bidang') == 'Bidang Pelayanan Medik' ? "selected" : ""}}>Bidang Pelayanan Medik</option>
                                <option value='Bidang Penunjang Medik' {{old('bidang') == 'Bidang Penunjang Medik' ? "selected" : ""}}>Bidang Penunjang Medik</option>
                                <option value='Bidang Keperawatan' {{old('bidang') == 'Bidang Keperawatan' ? "selected" : ""}}>Bidang Keperawatan</option>
                                <option value='Lainnya' {{old('bidang') == 'Lainnya' ? "selected" : ""}}>Lainnya</option>
                            </select>
                            @error('bidang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <!-- JPL -->
                        <div class="form-group">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori"  name="kategori">
                                    <option value=''>---Kategori---</option>
                                    <option value='Pelatihan' {{old('kategori') == 'Pelatihan' ? "selected" : ""}}>Pelatihan</option>
                                    <option value='IHT' {{old('kategori') == 'IHT' ? "selected" : ""}}>IHT</option>
                                    <option value='Seminar' {{old('kategori') == 'Seminar' ? "selected" : ""}}>Seminar</option>
                                    <option value='Bimtek' {{old('kategori') == 'Bimtek' ? "selected" : ""}}>Bimtek</option>
                                </select>
                                @error('kategori') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" placeholder="Nama Kegiatan" name="nama_kegiatan" value="{{old('nama_kegiatan')}}">
                            @error('nama_kegiatan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" placeholder="Tempat" name="tempat" value="{{old('tempat')}}">
                            @error('tempat') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" id="tgl_mulai" name="tgl_mulai" value="{{old('tgl_mulai')}}">
                            @error('tgl_mulai') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" id="tgl_selesai" name="tgl_selesai" value="{{old('tgl_selesai')}}">
                            @error('tgl_selesai') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="jpl">JPL</label>
                            <input type="number" class="form-control @error('jpl') is-invalid @enderror" id="jpl" placeholder="Misal 3" name="jpl" value="{{old('jpl')}}">
                            @error('jpl') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_sertif">No Sertifikat</label>
                            <input type="text" class="form-control @error('no_sertif') is-invalid @enderror" id="no_sertif" placeholder="Misal 0000/0000" name="no_sertif" value="{{old('no_sertif')}}">
                            @error('no_sertif') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit Sertifikat</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" placeholder="Penerbit" name="penerbit" value="{{old('penerbit')}}">
                            @error('penerbit') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{route('jpls.show', $jplUtama['id'])}})}}" class="btn btn-default">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stack('scripts')
@stop

@push ('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#no_pegawai").focusout(function(e){
            // alert($(this).val());
            var no_pegawai = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{route('get.all.fields')}}",
                data: {'no_pegawai':no_pegawai},
                dataType: 'json',
                success : function(data) {
                    $('#email_address').val(data.email_address);
                    $('#nama_pegawai').val(data.nama_pegawai);
                    $('#jk').val(data.jk);
                    $('#tk_pddkan').val(data.tk_pddkan);
                    $('#status_pekerjaan').val(data.status_pekerjaan);
                    $('#status_jabatan').val(data.status_jabatan);
                    $('#bidang').val(data.bidang);
                },
                error: function(response) {
                    alert(response.responseJSON.message);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready( function() {
            $('#no_pegawai').on('change', function() {
                $('#pegawai_id').val($(this).val());
            });
        });
    </script>
@endpush

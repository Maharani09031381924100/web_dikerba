<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Mahasiswa</title>
    <style>
        @page {
            size: 330mm 210mm; /* Custom F4 size */
        }
        body{
            /* margin: 0.5cm; */
            line-height: 1.15;
        }

        .judul1{
            text-align: center;
            color: #000000;
            font-size: 14pt;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        .teks{
            text-align: center;
            color: #000000;
            font-size: 12pt;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        .mahasiswa {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12pt;
        }

        .mahasiswa thead th, .mahasiswa td{
            border: 1px solid #000000;
            padding: 8px;
        }

        .mahasiswa thead th{
            vertical-align: bottom;
            /* border-bottom: 1px solid #dee2e6; */
            text-align: center;
            padding-bottom: 5px;
            color: #000000;
            font-family: Arial, Helvetica, sans-serif;
        }

        #footer {
            font-size: 12px;
            color: #000000;
            position: absolute;
            bottom: 0;
            right:0;
        }
    </style>
</head>
<body>
    {{-- kop surat --}}
    <table width="100%">
        <tr>
            <td width="25" style="text-align:center;">
                <img src="vendor/adminlte/dist/img/logoSumsel.jpg" width="60%">
            </td>
            <td width="75" style="text-align:center;">

                    <h1 style="font-size:16pt; font-family:Arial, Helvetica, sans-serif;margin:0">PEMERINTAH PROVINSI SUMATERA SELATAN</h1>
                    <h1 style="font-size:17pt; font-family:Arial, Helvetica, sans-serif;margin:0">DINAS KESEHATAN <br>
                        RUMAH SAKIT ERNALDI BAHAR <br>
                        PROVINSI SUMATERA SELATAN</h1>
                    <p style="font-family: Arial, Helvetica, sans-serif; font-size:10pt;margin:0">
                    Jl. Gubernur H. Muhammad Ali Amin, RT.20, RW.04 Kelurahan Alang-Alang Lebar
                    <br>
                    Kecamatan Alang-Alang Lebar Palembang, Provinsi Sumatera Selatan
                    <br>
                    Telp; (0711) 5646123, 5645126 Fax; (0711) 5645124
                    <br>
                    <b>Email :</b> <a href="#">Layanan@rs-erba.go.id</a> &nbsp;&nbsp;<b>Website :</b> <a href="#">www.rs-erba.go.id</a>
                </p>
            </td>
            <td width="15" style="text-align:center;"></td>
        </tr>
    </table>

    {{-- garis pembatas --}}
    <div style="border-top:1px solid; margin-top: 10pt;margin-bottom:1px;width:100%;"></div>
    <div style="border-top:4px solid;margin-bottom:10pt"></div>

    {{-- isi surat --}}
    <section class="sheet padding-10mm">
        <h2 class="judul1">
            LAPORAN MAHASISWA PRAKTIK
        </h2>
        <br>
        <h3 class="teks">Tabel 1. Daftar Mahasiswa Praktik</h3>
        <table border="1" cellpadding="5" cellspacing="1" class="mahasiswa">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Tingkat Pendidikan</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->jk }}</td>
                    <td>{{ $mahasiswa->univ->univ_name }}</td>
                    <td>{{ $mahasiswa->tingkatpendidikan->tkpendidikan_name }}</td>
                    <td>{{ date('d M Y', strtotime($mahasiswa->tgl_mulai)) }}</td>
                    <td>{{ date('d M Y', strtotime($mahasiswa->tgl_selesai)) }}</td>
                    <td>{{ $mahasiswa->ruangan->ruangan_name }}</td>
                    <td>{{ $mahasiswa->keterangan }}</td>
                    <td>{{ $mahasiswa->Kelulusan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <h3 class="teks">Tabel 2. Keterangan Instansi</h3>
        <table border="1" cellpadding="5" cellspacing="1" class="mahasiswa">
            <thead>
            <tr>
                <th>Instansi</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Program Studi</th>
                <th style="width: 20px">Tingkat pendidikan</th>
                <th>Ruangan</th>
                <th style="width: 20px">Jumlah Mahasiswa</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mhs as $key => $mahasiswa)
                <tr>
                    <td>{{ $key }}</td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            <p>{{  $key }}</p>
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                <p>{{  $key }}</p>
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    <p>{{  $key }}</p>
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        <p>{{  $key }}</p>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        @foreach($ma as $key => $m)
                                            <p>{{  $key }}</p>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        @foreach($ma as $m)
                                            <p>{{  $m->count() }}</p>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        @foreach($ma as $m)
                                            @foreach($m as $tgl)
                                                <p>{{ date('d M Y', strtotime($tgl->tgl_mulai)) }}</p>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        @foreach($ma as $m)
                                            @foreach($m as $tgl)
                                                <p>{{ date('d M Y', strtotime($tgl->tgl_selesai)) }}</p>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    {{-- footer --}}
    <div id="footer">
        <?php
            date_default_timezone_set('Asia/Jakarta');
            echo date('d-m-Y H:i:s');
        ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Detail JPL</title>
    <style>
        @page {
            size: 210mm 330mm; /* Custom F4 size */
        }

        body{
            /* margin: 0.5cm; */
            line-height: 1.15;
        }

        .detail {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 8pt;
        }

        .detail td, .detail th {
            border: 1px solid #000000;
            padding: 8px;
        }

        .detail tr:hover {background-color: #ddd;}

        .detail th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            color: black;
        }

        .judul1{
            text-align: center;
            color: #000000;
            font-size: 14pt;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
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
    <h2 class="judul1">
        DAFTAR JPL
        <?php
            echo strtoupper($jpl->pegawai->nama_pegawai);
        ?>
        &ensp;
        <?php
            echo($jplUtama->tahun);
        ?>
    </h2>
    <br>
    <table class="detail">
        <tr>
            <th style="width: 10px">No</th>
            <th>Nama Pegawai</th>
            <th>Kategori</th>
            <th style="width: 40px">Nama Kegiatan</th>
            <th style="width: 40px">Tempat</th>
            <th style="width: 40px">Tanggal Mulai</th>
            <th style="width: 40px">Tanggal Selesai</th>
            <th style="width: 10px">JPL</th>
            <th>No Sertifikat</th>
            <th>Penerbit Sertifikat</th>
        </tr>
        @foreach($jpls as $jpl)
        <tr>
            <td scope="row">{{$loop->iteration}}</td>
            <td>{{$jpl->pegawai->nama_pegawai}}</td>
            <td>{{$jpl->kategori}}</td>
            <td>{{$jpl->nama_kegiatan}}</td>
            <td>{{$jpl->tempat}}</td>
            <td>{{$jpl->tgl_mulai->format('d/m/Y')}}</td>
            <td>{{$jpl->tgl_selesai->format('d/m/Y')}}</td>
            <td>{{$jpl->jpl}}</td>
            <td>{{$jpl->no_sertif}}</td>
            <td>{{$jpl->penerbit}}</td>
        </tr>
        @endforeach
    </table>

    {{-- footer --}}
    <div id="footer">
        <?php
            date_default_timezone_set('Asia/Jakarta');
            echo date('d-m-Y H:i:s');
        ?>
    </div>
</body>
</html>



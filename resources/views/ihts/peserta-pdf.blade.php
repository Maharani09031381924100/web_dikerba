<!DOCTYPE html>
<html>
<head>
    <title>Peserta Kegiatan Pelatihan Diklat</title>
    <style>
        @page {
            size: 210mm 330mm; /* Custom F4 size */
        }
        body{
            /* margin: 0.5cm; */
            line-height: 1.15;
        }

        .peserta, .narasumber {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12pt;
        }

        .peserta td, .peserta th, .narasumber td, .narasumber th {
            border: 1px solid #000000;
            padding: 8px;
        }

        .peserta tr:hover {background-color: #ddd;}
        .narasumber tr:hover {background-color: #ddd;}

        .peserta th, #narasumber th {
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

        .subJudul{
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            color: #000000;
            font-size: 12pt;
            margin: 0;
        }

        .teks{
            text-align: center;
            color: #000000;
            font-size: 12pt;
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
        DAFTAR PESERTA PELATIHAN <?php echo strtoupper($iht->nama_pelatihan)?>
    </h2>
    <br>
    <p class="subJudul">
        <?php
        setlocale(LC_TIME, 'IND');
            echo carbon\Carbon::parse($iht->tgl_mulai)->formatLocalized('%d %B %Y');
        ?> -
        <?php
        echo carbon\Carbon::parse($iht->tgl_selesai)->formatLocalized('%d %B %Y');
        ?>
    </p>
    <br>
    <h3 class="teks">Tabel 1. Daftar Peserta Pelatihan</h3>
    <table class="peserta">
        <tr>
            <th style="width: 10px">No</th>
            <th>Nama Peserta</th>
            <th style="width: 300px">Tempat Tugas</th>
        </tr>
        @foreach ($pesertaIht as $pesertaIht)
        <tr>
            <td scope="row">{{$loop->iteration}}</th>
            <td>{{ $pesertaIht->nama_peserta}}</td>
            <td>{{ $pesertaIht->tempat_tugas}}</td>
        </tr>
        @endforeach
    </table>
    <br>
    <h3 class="teks">Tabel 2. Daftar Narasumber Pelatihan</h3>
    <table class="narasumber">
        <tr>
            <th style="width: 10px">No</th>
            <th>Nama Narasumber</th>
            <th style="width: 300px">Instansi Unit Kerja</th>
        </tr>
        @foreach ($narasumberIht as $narasumberIht)
        <tr>
            <td scope="row">{{$loop->iteration}}</th>
            <td>{{ $narasumberIht->nama_narasumber}}</td>
            <td>{{ $narasumberIht->instansi}}</td>
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



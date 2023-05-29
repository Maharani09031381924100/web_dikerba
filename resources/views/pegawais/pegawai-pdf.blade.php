<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pegawai</title>
    <style>
        @page {
            size: 210mm 330mm; /* Custom F4 size */
        }

        body{
            /* margin: 0.5cm; */
            line-height: 1.15;
        }

        .pegawai {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 10pt;
        }

        .pegawai td, .pegawai th {
            border: 1px solid #000000;
            padding: 2px;
        }

        .pegawai tr:hover {background-color: #ddd;}

        .pegawai th {
            padding-top: 8px;
            padding-bottom: 8px;
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
        DATA PEGAWAI RUMAH SAKIT ERNALDI BAHAR PALEMBANG
    </h2>
    <br>
    <table class="pegawai">
        <tr>
            <th style="width: 10px">No</th>
            <th>No. Pegawai</th>
            <th>Email</th>
            <th>Nama</th>
            <th style="width: 10px">JK</th>
            <th style="width: 10px">Tk Pddkan</th>
            <th style="width: 10px">Status Pekerjaan</th>
            <th style="width: 10px">Status Jabatan</th>
            <th style="width: 10px">Bidang / Bagian Tempat Bekerja</th>
        </tr>
        @foreach ($pegawai as $pegawai)
         <tr>
            <td scope="row">{{$loop->iteration}}</th>
            <td>{{$pegawai->no_pegawai}}</td>
            <td>{{$pegawai->email_address}}</td>
            <td>{{$pegawai->nama_pegawai}}</td>
            <td>{{$pegawai->jk}}</td>
            <td>{{$pegawai->tk_pddkan}}</td>
            <td>{{$pegawai->status_pekerjaan}}</td>
            <td>{{$pegawai->status_jabatan}}</td>
            <td>{{$pegawai->bidang}}</td>
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



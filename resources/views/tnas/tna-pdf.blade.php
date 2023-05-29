<!DOCTYPE html>
<html>
<head>
    <title>Laporan Training Need Analysis</title>
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

        .tna {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 8pt;
        }

        .tna td, .tna th {
            border: 1px solid #000000;
            padding: 4px;
        }

        .tna tr:hover {background-color: #ddd;}

        .tna th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            color: black;
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
        REKAP DATA TRAINING NEED ANALYSIS TAHUN {{($tnaUtama->tahun)}}
    </h2>
    <br>
    <table class="tna">
        <tr>
            <th style="width: 10px">No</th>
            <th>Email</th>
            <th>Nama</th>
            <th style="width: 10px">Umur</th>
            <th style="width: 10px">JK</th>
            <th style="width: 10px">Pendidikan</th>
            <th style="width: 10px">Status Pekerjaan</th>
            <th style="width: 10px">Status Jabatan</th>
            <th style="width: 10px">Lama Bekerja di Rumah Sakit</th>
            <th style="width: 10px">Lama Bekerja di Tempat Sekarang</th>
            <th style="width: 10px">Bidang / Bagian Tempat Bekerja</th>
            <th>Kompetensi yang wajib dimiliki berdasarkan Tupoksi</th>
            <th>Masalah yang dihadapi untuk pengembangan capaian kompetensi</th>
            <th>Pelatihan / IHT / seminar / workshop / teknis yang telah diikuti dalam 2 tahun terakhir (online/offline)</th>
            <th>Pelatihan / IHT /Prioritas untuk Pengembangan Kompetensi sesuai Tupoksi</th>
        </tr>
        @foreach ($tna as $tna)
         <tr>
            <td scope="row">{{$loop->iteration}}</th>
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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Mahasiswa Praktik</title>
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

        .laporan {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12pt;
        }

        .laporan thead th, .laporan td{
            border: 1px solid #000000;
            padding: 8px;
        }

        .laporan thead th{
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
        <table border="1" cellpadding="5" cellspacing="1" class="laporan">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Fakultas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col" style="width: 20px">Tingkat Pendidikan</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Tanggal Keluar</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporanpraktiks as $laporanpraktik)
                <tr>

                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $laporanpraktik->univ->univ_name }}</td>
                    <td>{{ $laporanpraktik->fakul->fakul_name }}</td>
                    <td>{{ $laporanpraktik->jurusan->jurusan_name }}</td>
                    <td>{{ $laporanpraktik->prodi->prodi_name }}</td>
                    <td>{{ $laporanpraktik->tingkatpendidikan->tkpendidikan_name }}</td>
                    <td>{{ date('d M Y', strtotime($laporanpraktik->tgl_mulai)) }}</td>
                    <td>{{ date('d M Y', strtotime($laporanpraktik->tgl_selesai)) }}</td>
                    <td>{{ $laporanpraktik->jumlah }}</td>
                    <td>{{ $laporanpraktik->keterangan }}</td>
                    <td>{{ $laporanpraktik->Kelulusan }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8">Total</td>
                    <td>{{ $laporanpraktiks->sum('jumlah') }}</td>
                    <td></td>
                    <td></td>
                </tr>
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

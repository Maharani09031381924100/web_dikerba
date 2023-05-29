<!DOCTYPE html>
<html>
<head>
    <title>Detail Kegiatan Pelatihan Diklat</title>
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
            font-size: 12pt;
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

        .subJudul{
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            color: #000000;
            font-size: 12pt;
            margin: 0;
        }

        .teks-table {
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            color: #000000;
            font-size: 12pt;
            margin: 0;
            border-collapse: collapse;
            width: 50%;
        }

        .teks-table td {
            padding: 8px;
        }

        .teks-table td:first-child {
            white-space: nowrap;
        }

        .teks-table b {
            font-weight: normal;
        }

        .teks-table td:first-child b {
            font-weight: bold;
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
        DAFTAR PELATIHAN KEGIATAN PELATIHAN <?php echo strtoupper($iht->nama_pelatihan)?>
    </h2>
    <br>
    <p class="subJudul">
        <?php
            setlocale(LC_TIME, 'IND');
            echo carbon\Carbon::parse($iht->tgl_mulai)->formatLocalized('%d %B %Y');
        ?>
        -
        <?php
        echo carbon\Carbon::parse($iht->tgl_selesai)->formatLocalized('%d %B %Y');
        ?>
    </p>
    <br>
    <table class="detail">
        <tr>
            <th>No</th>
            <th>Tanggal Pelaksanaan</th>
            <th>Detail Kegiatan</th>
            <th>Gelombang</th>
            <th>Tempat</th>
            <th>Jumlah Peserta</th>
            <th>Jumlah Narasumber</th>
        </tr>
        @foreach ($detailIht as $detailIht)
        <tr>
            <td scope="row">{{$loop->iteration}}</th>
            <td>{{ $detailIht->tgl_pelaksanaan->format('d/m/Y')}}</td>
            <td>{{ $detailIht->nama_detail}}</td>
            <td>{{ $detailIht->gelombang}}</td>
            <td>{{ $detailIht->tempat}}</td>
            <td>{{ $detailIht->peserta}}</td>
            <td>{{ $detailIht->narasumber}}</td>

        </tr>
        @endforeach
    </table>
    {{-- total peserta --}}
    <?php
        $total_peserta = DB::table('detail_ihts')->where(('iht_id'),'=',($iht['id']))->sum('peserta');
        $total_narasumber = DB::table('detail_ihts')->where(('iht_id'),'=',($iht['id']))->sum('narasumber');
        $total = $total_peserta + $total_narasumber;
    ?>
    <br>
    <table class="teks-table">
        <tr>
          <td style="width: 30%"><b>Total peserta pelatihan</b></td>
          <td>: {{$total_peserta}}</td>
        </tr>
        <tr>
          <td><b>Total narasumber pelatihan</b></td>
          <td>: {{$total_narasumber}}</td>
        </tr>
        <tr>
          <td><b>Total keseluruhan pelatihan</b></td>
          <td>: {{$total}}</td>
        </tr>
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



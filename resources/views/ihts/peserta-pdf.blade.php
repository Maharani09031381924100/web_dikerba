<!DOCTYPE html>
<html>
    <head>
    <style>
        #peserta, #narasumber {
        font-family: times-new-roman;
        border-collapse: collapse;
        width: 100%;
        }

        #peserta td, #peserta th , #narasumber td, #narasumber th{
        border: 1px solid #ddd;
        padding: 8px;
        }

        #peserta tr:hover {background-color: #ddd;}
        #narasumber tr:hover {background-color: #ddd;}

        #peserta th, #narasumber th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        color: black;
        }
    </style>
    </head>
<body>
    <h3 style="text-align:center;">
        DAFTAR PESERTA PELATIHAN <?php echo strtoupper($iht->nama_pelatihan)?>
    </h3>
    <p>Mulai dari tanggal
        <?php
        setlocale(LC_TIME, 'IND');
            echo carbon\Carbon::parse($iht->tgl_mulai)->formatLocalized('%d %B %Y');
        ?> sampai tanggal
        <?php
        echo carbon\Carbon::parse($iht->tgl_selesai)->formatLocalized('%d %B %Y');
        ?>
    </p>
    <p>Daftar Peserta Pelatihan</p>
    <table id="peserta">
        <tr>
            <th>No.</th>
            <th>Nama Peserta</th>
            <th>Tempat Tugas</th>
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

    <p>Daftar Narasumber Pelatihan</p>
    <table id="narasumber">
        <tr>
            <th>No.</th>
            <th>Nama Narasumber</th>
            <th>Instansi Unit Kerja</th>
        </tr>
        @foreach ($narasumberIht as $narasumberIht)
        <tr>
            <td scope="row">{{$loop->iteration}}</th>
            <td>{{ $narasumberIht->nama_narasumber}}</td>
            <td>{{ $narasumberIht->instansi}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>



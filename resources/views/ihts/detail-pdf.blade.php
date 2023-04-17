<!DOCTYPE html>
<html>
    <head>
    <style>
    #detail {
    font-family: times-new-roman;
    border-collapse: collapse;
    width: 100%;
    }

    #detail td, #detail th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #detail tr:hover {background-color: #ddd;}

    #detail th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    color: black;
    }
    </style>
    </head>
<body>
    <h3 style="text-align:center;">
        DAFTAR KEGIATAN PELATIHAN <?php echo strtoupper($iht->nama_pelatihan)?>
    </h3>
    <p>Mulai dari tanggal
        <?php
            setlocale(LC_TIME, 'IND');
            echo carbon\Carbon::parse($iht->tgl_mulai)->formatLocalized('%d %B %Y');
        ?>
        sampai tanggal
        <?php
        echo carbon\Carbon::parse($iht->tgl_selesai)->formatLocalized('%d %B %Y');
        ?></p>

    <table id="detail">
        <tr>
            <th>No.</th>
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
        <?php
        $total_peserta = DB::table('detail_ihts')->where(('iht_id'),'=',($iht['id']))->sum('peserta');
        $total_narasumber = DB::table('detail_ihts')->where(('iht_id'),'=',($iht['id']))->sum('narasumber');
        $total = $total_peserta + $total_narasumber;
        ?>
        <br>
        <p><b>Total peserta pelatihan&emsp;&emsp;&nbsp;: </b> {{$total_peserta}}</p>
        <p><b>Total narasumber pelatihan : </b> {{$total_narasumber}}</p>
        <p><b>Total keseluruhan pelatihan : </b> {{$total}}</p>
</body>
</html>



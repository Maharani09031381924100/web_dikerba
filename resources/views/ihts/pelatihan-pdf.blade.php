<!DOCTYPE html>
<html>
    <head>
    <style>
        #pelatihan {
        font-family: times-new-roman;
        border-collapse: collapse;
        width: 100%;
        }

        #pelatihan td, #pelatihan th {
        border: 1px solid #ddd;
        padding: 8px;
        }


        #pelatihan tr:hover {background-color: #ddd;}

        #pelatihan th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        color: black;
        }
    </style>
    </head>
<body>

    <h3 style="text-align:center;">
    DAFTAR PELATIHAN RUMAH SAKIT ERNALDI BAHAR PALEMBANG
    <?php
    setlocale(LC_TIME, 'IND');
    if ((($start)!=null)&&(($end)!=null)) {
         $start=carbon\Carbon::parse($start)->formatLocalized('%B %Y');
         $end=carbon\Carbon::parse($end)->formatLocalized('%B %Y');
        if (($start)==($end)) {
            echo strtoupper ($start);
        }
        else {
            echo strtoupper ($start);
            echo ' - ';
            echo strtoupper($end);
        }
    }
    ?>
    </h3>

    <table id="pelatihan">
        <tr>
            <th>No.</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Jenis Kegiatan</th>
            <th>Nama Pelatihan</th>
            <th>Status</th>
        </tr>
        @foreach ($iht as $iht)
        <tr>
            <td scope="row">{{$loop->iteration}}</th>
            <td>{{ $iht->tgl_mulai->format('d/m/Y') }}</td>
            <td>{{ $iht->tgl_selesai->format('d/m/Y') }}</td>
            <td>{{ $iht->jenis_kegiatan}}</td>
            <td>{{ $iht->nama_pelatihan}}</td>
            <td>{{ $iht->status}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>



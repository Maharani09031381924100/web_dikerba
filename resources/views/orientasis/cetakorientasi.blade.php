
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Orientasi</title>

    <style>
        *, ::after, ::before {
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 52px;
            color: #64748b;
        }
        .header .title {
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
        }
        .header .title span {
            color: #6777ef;
        }
        .header .sub-title {
            font-size: 12px;
            font-weight: 500;
            color: #6777ef;
        }
        .header .sub-title strong {
            color: #64748b;
        }
        table {
            width: 100%;
            margin-bottom: 52px;
            color: #64748b;
            font-size: 12px;
        }
        table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
            padding-bottom: 5px;
            color: #475569;
        }
    </style>
</head>

<body>
<div class="header">
    <h1 class="title">Laporan Orientasi Pegawai</h1>

</div>
<form action="{{ route('cetakorientasi') }}" method="GET">
    &nbsp; <span  class="date-label">From: </span><input class="date_range_filter date" type="date"  name="start_date"/>
    &nbsp; <span  class="date-label">To: <input class="date_range_filter date" type="date" name="end_date" />

    <button class="btn btn-primary btn-xs" type="submit">submit</button>
</form>
<br><br>
<form action="{{ route('downloadorientasipdf') }}" method="Post">
    @csrf

    @foreach ($orientasis as $orientasi)
    <input type="text" name="orientasis[]" value="{{ $orientasi->id }}" hidden>
    @endforeach

    <button type="submit" formtarget="_blank">Cetak</button>
</form>

        <div class="row">
            <table>
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col">Status Pegawai</th>
                    <th scope="col">Pendidikan</th>
                    <th scope="col">Asal Tempat Kerja</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($orientasis as $key => $orientasi)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $orientasi->name }}</td>
                        <td>{{ $orientasi->jk }}</td>
                        <td>{{ date('d M Y', strtotime($orientasi->tgl_orientasi)) }}</td>
                        <td>{{ date('d M Y', strtotime($orientasi->tgl_selesaiorientasi)) }}</td>
                        <td>{{ $orientasi->status_pegawai }}</td>
                        <td>{{ $orientasi->pendidikan }}</td>
                        <td>{{ $orientasi->asal }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
</body>
</html>

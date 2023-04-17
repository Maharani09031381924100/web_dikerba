<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Mahasiswa Praktik</title>
    <style>

        table {
            width: 100%;
            margin-bottom: 52px;
            color: #475569;
            font-size: 12px;
        }
        table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
            padding-bottom: 5px;
            color: #475569;
        }
    </style>
</head>
<body class="A4">
    <section class="sheet padding-10mm">
        <h1 style="color: #475569; text-align: center;">Laporan Mahasiswa Praktik</h1>

        <table border="1" cellpadding="5" cellspacing="1" class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Fakultas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Tingkat Pendidikan</th>
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
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Mahasiswa</title>

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

<body>
    <div class="header">
        <h1 class="title" style="color: #475569; text-align: center;">Laporan Mahasiswa Praktik</h1>

    </div>
    <form action="{{ route('cetakmahasiswa') }}" method="GET">
        &nbsp; <span  class="date-label">From: </span><input class="date_range_filter date" type="date"  name="start_date"/>
        &nbsp; <span  class="date-label">To: <input class="date_range_filter date" type="date" name="end_date" />

        <button class="btn btn-primary btn-xs" type="submit">submit</button>
    </form>
    <br><br>
    <form action="{{ route('downloadmahasiswapdf') }}" method="post">
        @csrf

        @foreach ($mahasiswas as $mahasiswa)
            <input type="text" name="mahasiswas[]" value="{{ $mahasiswa->id }}" hidden>
        @endforeach

        <button type="submit" formtarget="_blank">Cetak</button><br><br>
    </form>
        <div class="row">
            <table border="1" cellpadding="5" cellspacing="1" class="table">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Fakultas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Tingkat Pendidikan</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status Kelulusan</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswas as $key => $mahasiswa)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                        <td>{{ $mahasiswa->nim }}</td>
                        <td>{{ $mahasiswa->jk }}</td>
                        <td>{{ $mahasiswa->univ->univ_name }}</td>
                        <td>{{ $mahasiswa->fakul->fakul_name }}</td>
                        <td>{{ $mahasiswa->jurusan->jurusan_name }}</td>
                        <td>{{ $mahasiswa->prodi->prodi_name }}</td>
                        <td>{{ $mahasiswa->tingkatpendidikan->tkpendidikan_name }}</td>
                        <td>{{ $mahasiswa->semester }}</td>
                        <td>{{ date('d M Y', strtotime($mahasiswa->tgl_mulai)) }}</td>
                        <td>{{ date('d M Y', strtotime($mahasiswa->tgl_selesai)) }}</td>
                        <td>{{ $mahasiswa->ruangan->ruangan_name }}</td>
                        <td>{{ $mahasiswa->keterangan }}</td>
                        <td>{{ $mahasiswa->Kelulusan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
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
<body class="A4">
    <section class="sheet padding-10mm">
        <h1 style="color: #475569; text-align: center;">Laporan Mahasiswa</h1>

        <table border="1" cellpadding="5" cellspacing="1" class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Tingkat Pendidikan</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->jk }}</td>
                    <td>{{ $mahasiswa->univ->univ_name }}</td>
                    <td>{{ $mahasiswa->tk_pendidikan }}</td>
                    <td>{{ date('d M Y', strtotime($mahasiswa->tgl_mulai)) }}</td>
                    <td>{{ date('d M Y', strtotime($mahasiswa->tgl_selesai)) }}</td>
                    <td>{{ $mahasiswa->ruangan->ruangan_name }}</td>
                    <td>{{ $mahasiswa->keterangan }}</td>
                    <td>{{ $mahasiswa->Kelulusan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table border="1" cellpadding="5" cellspacing="1" class="table">
            <thead>
            <tr>
                <th>Instansi</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Program Studi</th>
                <th>Tingkat pendidikan</th>
                <th>Ruangan</th>
                <th>Jumlah</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mhs as $key => $mahasiswa)
                <tr>
                    <td>{{ $key }}</td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            <p>{{  $key }}</p>
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                <p>{{  $key }}</p>
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    <p>{{  $key }}</p>
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        <p>{{  $key }}</p>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        @foreach($ma as $key => $m)
                                            <p>{{  $key }}</p>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        @foreach($ma as $m)
                                            <p>{{  $m->count() }}</p>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        @foreach($ma as $m)
                                            @foreach($m as $tgl)
                                                <p>{{ date('d M Y', strtotime($tgl->tgl_mulai)) }}</p>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>

                    <td>
                        @foreach($mahasiswa as $key => $mahas)
                            @foreach($mahas as $key => $maha)
                                @foreach($maha as $key => $mah)
                                    @foreach($mah as $key => $ma)
                                        @foreach($ma as $m)
                                            @foreach($m as $tgl)
                                                <p>{{ date('d M Y', strtotime($tgl->tgl_selesai)) }}</p>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>

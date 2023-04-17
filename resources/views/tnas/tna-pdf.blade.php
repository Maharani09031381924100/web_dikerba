<!DOCTYPE html>
<html>
<head>
<style>
#tna {
  font-family: times-new-roman;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}

#tna td, #tna th {
  border: 1px solid #ddd;
  /* padding: 8px; */
}
.width-lg {
    width: 100px !important;
}
.width-md {
    width: 30px !important;
}

#tna tr:hover {background-color: #ddd;}

#tna th {
  padding-top: 8px;
  padding-bottom: 8px;
  width:100%;
  text-align: center;
  color: black;
}
</style>
</head>
<body>

<h3 style="text-align:center;">
    REKAP DATA TRAINING NEED ANALYSIS TAHUN {{($tnaUtama->tahun)}}
</h3>

<table id="tna">
    <tr>
        <th class="width-md">No.</th>
        <th>Email</th>
        <th>Nama</th>
        <th>Umur</th>
        <th>Jenis Kelamin</th>
        <th>Tingkat Pendidikan</th>
        <th>Status Pekerjaan</th>
        <th>Status Jabatan</th>
        <th>Lama Bekerja di Rumah Sakit</th>
        <th>Lama Bekerja di Tempat Sekarang</th>
        <th>Bidang/Bagian Tempat Bekerja</th>
        <th class="width-lg">Kompetensi yang wajib dimiliki berdasarkan Tupoksi</th>
        <th class="width-lg">Masalah yang dihadapi untuk pengembangan capaian kompetensi</th>
        <th class="width-lg">Pelatihan / IHT / seminar / workshop / teknis yang telah diikuti dalam 2 tahun terakhir (online/offline)</th>
        <th class="width-lg">Pelatihan / IHT /Prioritas untuk Pengembangan Kompetensi sesuai Tupoksi</th>
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
</body>
</html>



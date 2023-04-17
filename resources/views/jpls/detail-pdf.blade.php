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
    DAFTAR JPL
    <?php
        echo strtoupper($jpl->pegawai->nama_pegawai);
    ?>
    &ensp;
    <?php
        echo($jplUtama->tahun);
    ?>
</h3>

<table id="detail" class="table table-responsive">
    <tr>
        <th>No.</th>
        <th>Nama Pegawai</th>
        <th>Kategori</th>
        <th>Nama Kegiatan</th>
        <th>Tempat</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>JPL</th>
        <th>No Sertifikat</th>
        <th>Penerbit Sertifikat</th>
    </tr>
    @foreach($jpls as $jpl)
    <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$jpl->pegawai->nama_pegawai}}</td>
        <td>{{$jpl->kategori}}</td>
        <td>{{$jpl->nama_kegiatan}}</td>
        <td>{{$jpl->tempat}}</td>
        <td>{{$jpl->tgl_mulai->format('d/m/Y')}}</td>
        <td>{{$jpl->tgl_selesai->format('d/m/Y')}}</td>
        <td>{{$jpl->jpl}}</td>
        <td>{{$jpl->no_sertif}}</td>
        <td>{{$jpl->penerbit}}</td>
    </tr>
    @endforeach
</table>
</body>
</html>



<!DOCTYPE html>
<html>
<head>
<style>
#pegawai {
  font-family: times-new-roman;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}

#pegawai td, #pegawai th {
  border: 1px solid #ddd;
  padding: 8px;
}

#pegawai tr:hover {background-color: #ddd;}

#pegawai th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: center;
  color: black;
}
</style>
</head>
<body>

<h3 style="text-align:center;">
    DATA PEGAWAI RUMAH SAKIT ERNALDI BAHAR PALEMBANG
</h3>

<table id="pegawai">
    <tr>
        <th>No.</th>
        <th>No. Pegawai</th>
        <th>Email</th>
        <th>Nama</th>
        <th>JK</th>
        <th>Tk Pddkan</th>
        <th>Status Pekerjaan</th>
        <th>Status Jabatan</th>
        <th>Bidang/Bagian Tempat Bekerja</th>
    </tr>
    @foreach ($pegawai as $pegawai)
     <tr>
        <td scope="row">{{$loop->iteration}}</th>
        <td>{{$pegawai->no_pegawai}}</td>
        <td>{{$pegawai->email_address}}</td>
        <td>{{$pegawai->nama_pegawai}}</td>
        <td>{{$pegawai->jk}}</td>
        <td>{{$pegawai->tk_pddkan}}</td>
        <td>{{$pegawai->status_pekerjaan}}</td>
        <td>{{$pegawai->status_jabatan}}</td>
        <td>{{$pegawai->bidang}}</td>
    </tr>
    @endforeach
</table>
</body>
</html>



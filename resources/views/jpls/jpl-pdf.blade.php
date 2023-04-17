<!DOCTYPE html>
<html>
<head>
<style>
#jpl {
  font-family: times-new-roman;
  border-collapse: collapse;
  width: 100%;
}

#jpl td, #jpl th {
  border: 1px solid #ddd;
  padding: 8px;
}

#jpl tr:hover {background-color: #ddd;}

#jpl th {
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
        echo($jplUtama->tahun);
    ?>
</h3>

<table id="jpl">
    <tr>
        <th>No.</th>
        <th>Nama Pegawai</th>
        <th>Total JPL</th>
    </tr>
    @foreach($jpl as $jpl)
    <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$jpl->pegawai->nama_pegawai}}</td>
        <td>
        <?php
            $total_jpl = DB::table('jpls')->where(('jpl_id'),'=',($jplUtama['id']))->where('pegawai_id', $jpl['pegawai_id'])->sum('jpl');
            echo $total_jpl;
        ?>
        </td>
    </tr>
@endforeach
</table>
</body>
</html>



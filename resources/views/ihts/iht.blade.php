@extends('adminlte::page')

@section('title', 'Daftar Kegiatan Diklat | Website Dikerba')

@section('content_header')
    <h1>Daftar Kegiatan Instalasi Diklat dan Litbang</h1>
    <p>RS Ernaldi Bahar Provinsi Sumatra Selatan</p>
@stop

@section('content')


<!-- Modal Input-->
<div class="modal fade" id="ihtModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="ihtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ihtModalLabel">Form Input Kegiatan Pelatihan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/iht" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" aria-describedby="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai') }}" class="date">
                                @error('tgl_mulai')
                                    <div class="invalid-feedback">
                                        {{$message}};
                                    </div>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" aria-describedby="waktuHelp" name="tgl_selesai" value="{{ old('tgl_selesai') }}" class="date">
                                @error('tgl_selesai')
                                    <div class="invalid-feedback">
                                        {{$message}};
                                    </div>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kegiatan">Jenis Kegiatan</label>
                            <select type="text" class="form-control @error('jenis_kegiatan') is-invalid @enderror" name="jenis_kegiatan">
                                <option disabled selected value>---Jenis Kegiatan---</option>
                                <option value='Pelatihan' {{old('jenis_kegiatan') == 'Pelatihan' ? "selected" : ""}}>Pelatihan</option>
                                <option value='IHT' {{old('jenis_kegiatan') == 'IHT' ? "selected" : ""}}>IHT</option>
                                <option value='Seminar' {{old('jenis_kegiatan') == 'Seminar' ? "selected" : ""}}>Seminar</option>
                                <option value='Bimtek' {{old('jenis_kegiatan') == 'Bimtek' ? "selected" : ""}}>Bimbingan Teknologi (Bimtek)</option>
                            </select>
                            @error('jenis_kegiatan') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="namaInput" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control @error('nama_pelatihan') is-invalid @enderror" aria-describedby="namaHelp" placeholder="Nama Pelatihan" name="nama_pelatihan" value="{{ old('nama_pelatihan') }}">
                                @error('nama_pelatihan')
                                    <div class="invalid-feedback">
                                        {{$message}};
                                    </div>
                                @enderror
                    </div>
                    <div class="mb-3">
                            <label for="status">Status Kegiatan</label>
                                <select type="text" class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option disabled selected value>---Status Kegiatan---</option>
                                    <option value='Terjadwal' {{old('status') == 'Terjadwal' ? "selected" : ""}}>Terjadwal</option>
                                    <option value='Pending' {{old('status') == 'Pending' ? "selected" : ""}}>Pending</option>
                                </select>
                                @error('status') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Modal Edit-->
<div class="modal fade" id="ihtModalEdit" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="ihtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ihtModalLabel">Form Edit Kegiatan Pelatihan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/iht" id="editForm">
                    @method ('patch')
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{old('id')}}">
                    <div class="mb-3">
                        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" id="tgl_mulai" aria-describedby="namaHelp" name="tgl_mulai" value="{{ old('tgl_mulai') }}">
                                @error('tgl_mulai')
                                    <div class="invalid-feedback">
                                        {{$message}};
                                    </div>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror"  id="tgl_selesai" aria-describedby="waktuHelp" name="tgl_selesai" value="{{ old('tgl_selesai') }}">
                                @error('tgl_selesai')
                                    <div class="invalid-feedback">
                                        {{$message}};
                                    </div>
                                @enderror
                    </div>
                    <div class="mb-3">
                            <label for="jenis_kegiatan">Jenis Kegiatan</label>
                                <select type="text" class="form-control @error('jenis_kegiatan') is-invalid @enderror" id="jenis_kegiatan"  name="jenis_kegiatan">
                                    <option disabled selected value>---Jenis Pelatihan---</option>
                                    <option value='Pelatihan' {{old('jenis_kegiatan') == 'Pelatihan' ? "selected" : ""}}>Pelatihan</option>
                                    <option value='IHT' {{old('jenis_kegiatan') == 'IHT' ? "selected" : ""}}>IHT</option>
                                    <option value='Seminar' {{old('jenis_kegiatan') == 'Seminar' ? "selected" : ""}}>Seminar</option>
                                    <option value='Bimtek' {{old('jenis_kegiatan') == 'Bimtek' ? "selected" : ""}}>Bimbingan Teknologi (Bimtek)</option>
                                </select>
                                @error('jenis_kegiatan') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="namaInput" class="form-label">Nama Pelatihan</label>
                            <input type="text" class="form-control @error('nama_pelatihan') is-invalid @enderror" id="nama_pelatihan" aria-describedby="namaHelp" placeholder="Nama Pelatihan" name="nama_pelatihan" value="{{ old('nama_pelatihan') }}">
                                @error('nama_pelatihan')
                                    <div class="invalid-feedback">
                                        {{$message}};
                                    </div>
                                @enderror
                    </div>
                    <div class="mb-3">
                            <label for="status">Status Kegiatan</label>
                                <select type="text" class="form-control @error('status') is-invalid @enderror" id="status"  name="status">
                                    <option disabled selected value>---Status Kegiatan---</option>
                                    <option value='Terjadwal' {{old('status') == 'Terjadwal' ? "selected" : ""}}>Terjadwal</option>
                                    <option value='Pending' {{old('status') == 'Pending' ? "selected" : ""}}>Pending</option>
                                </select>
                                @error('status') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="update_data" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Modal PDF-->
<div class="modal fade" id="pdfModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="pdfModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Download Laporan PDF Daftar Pelatihan</h5>
            </div>
            <div class="modal-body">
                <form method="get" action="/cetakPelatihan">
                    <div class="mb-3">
                        <label for="startdate" class="form-label">Tanggal Mulai</label>
                        <input type="date"class="date_range_filter date"   name="startdate"/>
                    </div>
                    <div class="mb-3">
                        <label for="enddate" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="date_range_filter date"  name="enddate"/>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                         <button type="submit" id="download" class="btn btn-primary">Download</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Excel-->
<div class="modal fade" id="excelModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="excelModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excelModalLabel">Download Laporan Excel Daftar Pelatihan</h5>
            </div>
            <div class="modal-body">
                <form method="get" action="/excelPelatihan">
                   <div class="mb-3">
                       <label for="startdate" class="form-label">Tanggal Mulai</label>
                       <input type="date"class="date_range_filter date"   name="startdate"/>
                   </div>
                   <div class="mb-3">
                       <label for="enddate" class="form-label">Tanggal Selesai</label>
                       <input type="date" class="date_range_filter date"  name="enddate"/>
                   </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="download" class="btn btn-primary">Download</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" style="padding: 10px">
                        {{session('status')}}
                    </div>
                @endif
                <!-- Button trigger modal -->
                <div style="margin: 3px 1px">
                    <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#ihtModal">
                        <i class="fa fa-plus"></i> Tambah Pelatihan
                    </button>
                    <button type="button" class="btn btn-danger my-2" data-toggle="modal" data-target="#pdfModal">
                        <i class="far fa-fw fa-file"></i> PDF
                    </button>
                    <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#excelModal">
                        <i class="far fa-fw fa-file"></i> EXCEL
                    </button>
                </div>
                <form action="/filterPelatihan">
                    &nbsp; <span  class="date-label">Dari: </span><input class="date_range_filter date" type="date"  name="startdate"/>
                    &nbsp; <span  class="date-label">Sampai: <input class="date_range_filter date" type="date" name="enddate" />
                    <button type="submit" class="btn btn-primary my-2" >Filter</button>
                </form>
                <br><br>
                <!-- Show data -->
                <div class="table-responsive">
                <table class="table table-hover table-bordered table-stripped" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px">No. </th>
                            <th class="d-none d-X-block"></th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Jenis Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Status Kegiatan</th>
                        @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                        @endif
                            <!-- <th scope="col">Jadwal Kegiatan</th> -->
                            <th scope="col" style="width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($iht as $iht)
                            <tr>
                                <th scope="row"></th>
                                <td class="d-none d-X-block">{{$iht->id}}</td>
                                <td>{{ $iht->tgl_mulai->format('Y-m-d') }}</td>
                                <td>{{ $iht->tgl_selesai->format('Y-m-d') }}</td>
                                <td>{{ $iht->jenis_kegiatan}}</td>
                                <td>{{ $iht->nama_pelatihan}}</td>
                                <td>{{ $iht->status}}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($iht->created_at)) }}</td>
                                <td>{{ date('d M Y', strtotime($iht->updated_at)) }}</td>
                                @endif
                                <td>
                                    <a href="" class=" btn btn-success editbtn btn-sm" style="margin: 3px 1px;" data-toggle="modal" data-target="#ihtModalEdit"><i class="fa fa-pencil-square"></i></a>
                                        <form action="{{route('iht.destroy',$iht['id'])}}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" style="margin: 3px 1px;" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    <a href="/iht/{{$iht -> id}}" class="btn btn-info btn-sm" style="margin: 3px 1px;"><i class="fa fa-info" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stack('scripts')
@stop

@push('js')
    <script>
        var table=$('#dataTable').DataTable({
            "columnDefs": [
                { "searchable": false,
                    "orderable": false,
                    "targets": [0,7]
                } //disable first and last column sorting
            ],
        });
      //fixed number first column
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
                table.cell(cell).invalidate('dom');//generate to pdf/excel
            } );
        } ).draw();
        //script for edit old value
    table.on('click', '.editbtn', function(){
        $tr=$(this).closest('tr');
        if ($($tr).hasClass('child')){
            $tr=$tr.prev('.parent');
        }
        var data=table.row($tr).data();
        console.log(data);

        $('#id').val(data[1]);
        $('#tgl_mulai').val(data[2]);
        $('#tgl_selesai').val(data[3]);
        $('#jenis_kegiatan').val(data[4]);
        $('#nama_pelatihan').val(data[5]);
        $('#status').val(data[6]);

        $('#editForm').attr('action', '/iht/'+data[1]);
        $('#ihtModalEdit').modal('show');
    });
    </script>
@endpush


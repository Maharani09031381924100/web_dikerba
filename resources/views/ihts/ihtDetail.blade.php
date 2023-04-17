@extends('adminlte::page')

@section('title', 'Daftar Detail Kegiatan Diklat | Website Dikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Kegiatan Pelatihan</h1>
@stop

@section('content')

<!-- Modal Detail Input-->
<div class="modal fade" id="ihtDetailModal" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="ihtDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ihtDetailModalLabel">Form Detail Kegiatan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/addDetail">
                    @csrf
                    <div class="mb-3">
                        <label for="tgl_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control @error('tgl_pelaksanaan') is-invalid @enderror" aria-describedby="namaHelp" name="tgl_pelaksanaan" value="{{ old('tgl_pelaksanaan') }}">
                            @error('tgl_pelaksanaan')
                                <div class="invalid-feedback">
                                    {{$message}};
                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_detail" class="form-label">Nama Detail Kegiatan</label>
                        <input type="text" class="form-control @error('nama_detail') is-invalid @enderror" aria-describedby="namaHelp" placeholder="Nama Detail Kegiatan" name="nama_detail" value="{{ old('nama_detail') }}">
                            @error('nama_detail')
                                <div class="invalid-feedback">
                                    {{$message}};
                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gelombang" class="form-label">Gelombang/Batch</label>
                            <select type="text" class="form-control @error('gelombang') is-invalid @enderror" name="gelombang">
                                <option disabled selected value>---Gelombang---</option>
                                <option value='Gelombang 1' {{old('gelombang') == 'Gelombang 1' ? "selected" : ""}}>Gelombang 1</option>
                                <option value='Gelombang 2' {{old('gelombang') == 'Gelombang 2' ? "selected" : ""}}>Gelombang 2</option>
                                <option value='Gelombang 3' {{old('gelombang') == 'Gelombang 3' ? "selected" : ""}}>Gelombang 3</option>
                                <option value='Gelombang 4' {{old('gelombang') == 'Gelombang 4' ? "selected" : ""}}>Gelombang 4</option>
                                <option value='Gelombang 5' {{old('gelombang') == 'Gelombang 5' ? "selected" : ""}}>Gelombang 5</option>
                            </select>
                            @error('gelombang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempat" class="form-label">Tempat</label>
                            <select type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat">
                                <option disabled selected value>---Tempat---</option>
                                <option value='Ruang Kelas A' {{old('tempat') == 'Ruang Kelas A' ? "selected" : ""}}>Ruang kelas A</option>
                                <option value='Ruang Kelas B' {{old('tempat') == 'Ruang Kelas B' ? "selected" : ""}}>Ruang kelas B</option>
                                <option value='GSG' {{old('tempat') == 'GSG' ? "selected" : ""}}>GSG</option>
                                <option value='Lainnya' {{old('tempat') == 'Lainnya' ? "selected" : ""}}>Lainnya</option>
                            </select>
                            @error('tempat') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div id="otherType" style="display:none;" class="mb-3">
                        <label for="tempatInput">Jika memilih 'Lainnya', silahkan isi tempat kegiatan di bawah ini:</label>
                        <input type="text" id="tempatInput" class="form-control @error('tempat') is-invalid @enderror" aria-describedby="namaHelp" placeholder="Tempat kegiatan" name="tempat" value="{{ old('tempat') }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="pesertaInput" class="form-label">Jumlah Peserta</label>
                        <input type="number" class="form-control @error('peserta') is-invalid @enderror" aria-describedby="pesertaHelp"  pattern="Masukkan angka" placeholder="Jumlah Peserta" name="peserta" value="{{ old('peserta') }}">
                            @error('peserta')
                                <div class="invalid-feedback">
                                    {{$message}};
                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="narasumberInput" class="form-label">Jumlah Narasumber</label>
                        <input type="number" class="form-control @error('narasumber') is-invalid @enderror" aria-describedby="narasumberHelp"  pattern="Masukkan angka" placeholder="Jumlah Narasumber" name="narasumber" value="{{ old('narasumber') }}">
                            @error('narasumber')
                                <div class="invalid-feedback">
                                    {{$message}};
                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="iht_id" value="{{ $iht->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="simpanBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Edit-->
<div class="modal fade" id="ihtDetailModalEdit" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="ihtDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ihtDetailModalLabel">Form Edit Peserta Kegiatan Pelatihan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/editDetail" id="editDetailForm">
                    @method ('patch')
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{old('id')}}">
                    <div class="mb-3">
                        <label for="tgl_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control @error('tgl_pelaksanaan') is-invalid @enderror" id="tgl_pelaksanaan" aria-describedby="namaHelp" name="tgl_pelaksanaan" value="{{ old('tgl_pelaksanaan') }}">
                            @error('tgl_pelaksanaan')
                                <div class="invalid-feedback">
                                    {{$message}};
                                </div>
                            @enderror
                    </div>
                     <div class="mb-3">
                        <label for="nama_detail" class="form-label">Nama Detail Kegiatan</label>
                        <input type="text" class="form-control @error('nama_detail') is-invalid @enderror" id="nama_detail" aria-describedby="namaHelp" placeholder="Nama Detail Kegiatan" name="nama_detail" value="{{ old('nama_detail') }}">
                            @error('nama_detail')
                                <div class="invalid-feedback">
                                    {{$message}};
                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gelombang" class="form-label">Gelombang/Batch</label>
                            <select type="text" class="form-control @error('gelombang') is-invalid @enderror" id="gelombang" name="gelombang">
                                <option disabled selected value>---Gelombang---</option>
                                <option value='Gelombang 1' {{old('gelombang') == 'Gelombang 1' ? "selected" : ""}}>Gelombang 1</option>
                                <option value='Gelombang 2' {{old('gelombang') == 'Gelombang 2' ? "selected" : ""}}>Gelombang 2</option>
                                <option value='Gelombang 3' {{old('gelombang') == 'Gelombang 3' ? "selected" : ""}}>Gelombang 3</option>
                                <option value='Gelombang 4' {{old('gelombang') == 'Gelombang 4' ? "selected" : ""}}>Gelombang 4</option>
                                <option value='Gelombang 5' {{old('gelombang') == 'Gelombang 5' ? "selected" : ""}}>Gelombang 5</option>
                            </select>
                            @error('gelombang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempat" class="form-label">Tempat</label>
                            <select type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat">
                                <option disabled selected value>---Tempat---</option>
                                <option value='Ruang Kelas A' {{old('tempat') == 'Ruang Kelas A' ? "selected" : ""}}>Ruang kelas A</option>
                                <option value='Ruang Kelas B' {{old('tempat') == 'Ruang Kelas B' ? "selected" : ""}}>Ruang kelas B</option>
                                <option value='GSG' {{old('tempat') == 'GSG' ? "selected" : ""}}>GSG</option>
                                <option value='Lainnya' {{old('tempat') == 'Lainnya' ? "selected" : ""}}>Lainnya</option>
                            </select>
                            @error('tempat') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div id="otherTypeEdit" style="display:none;" class="mb-3">
                        <label for="tempatInput">Jika memilih 'Lainnya', silahkan isi tempat kegiatan di bawah ini:</label>
                        <input type="text" id="tempatInputEdit" class="form-control @error('tempat') is-invalid @enderror" aria-describedby="namaHelp" placeholder="Tempat kegiatan" name="tempat" value="{{ old('tempat') }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="pesertaInput" class="form-label">Jumlah Peserta</label>
                        <input type="number" class="form-control @error('peserta') is-invalid @enderror" aria-describedby="pesertaHelp"  pattern="Masukkan angka" placeholder="Jumlah Peserta" id="peserta" name="peserta" value="{{ old('peserta') }}">
                            @error('peserta')
                                <div class="invalid-feedback">
                                    {{$message}};
                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="narasumberInput" class="form-label">Jumlah Narasumber</label>
                        <input type="number" class="form-control @error('narasumber') is-invalid @enderror" aria-describedby="narasumberHelp"  pattern="Masukkan angka" placeholder="Jumlah Narasumber" id="narasumber" name="narasumber" value="{{ old('narasumber') }}">
                            @error('narasumber')
                                <div class="invalid-feedback">
                                    {{$message}};
                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="iht_id" value="{{ $iht->id }}">
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Input -->
                <!-- Message if success -->
                @if (session('status'))
                    <div class="alert alert-success" style="padding: 10px">
                        {{session('status')}}
                    </div>
                @endif
                <?php
                    $connection=mysqli_connect("localhost", "root", "", "web_dikerba");
                    $query="SELECT id FROM detail_ihts where iht_id = $iht->id ORDER BY id";
                    $query_run = mysqli_query($connection, $query);
                    $rowA=mysqli_num_rows($query_run);
                ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#ihtDetailModal" id="detailIhtBtn">
                    <i class="fa fa-plus"></i> Tambah Detail Kegiatan
                </button>
                <a href="/cetakDetail/{{$iht['id']}}" class="btn btn-danger my-2">
                    <i class="far fa-fw fa-file"></i> PDF
                </a>
                <a href="/excelDetail/{{$iht['id']}}" class="btn btn-success my-2">
                    <i class="far fa-fw fa-file"></i> EXCEL
                </a>
                <br>
                <p style="text-align: left; margin: 12px 0px;">Dari:&ensp;<b>{{ $iht->tgl_mulai->format('d/m/Y')}}</b>&ensp;Sampai:&ensp;<b>{{ $iht->tgl_selesai->format('d/m/Y')}}</b></p>
                <!-- Show Detail Kegiatan -->
                <div class="table-responsive">
                <table class="table table-hover table-bordered table-stripped" id="detailIhtTabel">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px">No.</th>
                            <th style="display:none"></th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Detail Kegiatan</th>
                            <th>Gelombang</th>
                            <th>Tempat</th>
                            <th>Jumlah Peserta</th>
                            <th>Jumlah Narasumber</th>
                            @if(auth()->user()->role=='admin')
                            <th>Dibuat</th>
                            <th>Diperbaharui</th>
                            @endif
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailIht as $detailIht)
                            <tr>
                                <th scope="row" style="text-align:center"></th>
                                <td style="display:none">{{$detailIht->id}}</td>
                                <td style="text-align:center">{{ $detailIht->tgl_pelaksanaan->format('Y-m-d')}}</td>
                                <td style="text-align:center">{{ $detailIht->nama_detail}}</td>
                                <td style="text-align:center">{{ $detailIht->gelombang}}</td>
                                <td style="text-align:center">{{ $detailIht->tempat}}</td>
                                <td style="text-align:center">{{ $detailIht->peserta}}</td>
                                <td style="text-align:center">{{ $detailIht->narasumber}}</td>
                                @if(auth()->user()->role=='admin')
                                <td>{{ date('d M Y', strtotime($detailIht->created_at)) }}</td>
                                <td>{{ date('d M Y', strtotime($detailIht->updated_at)) }}</td>
                                @endif
                                <td>
                                    <a href="" class=" btn btn-success editbtn btn-sm" style="margin: 3px 1px;" data-toggle="modal" data-target="#ihtDetailModalEdit"><i class="fa fa-pencil-square"></i></a>
                                    <form action="/deleteDetail/{{$detailIht->id}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" style="margin: 3px 1px;" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a href="/iht/{{$iht->id}}/{{$detailIht->id}}" class="btn btn-info btn-sm" style="margin: 3px 1px;"><i class="fa fa-info" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                <table id="totalTabel" class="display">
                    <thead class="table-light">
                        <tr>
                            <th >Total Peserta</th>
                            <th scope="col" class="d-none d-X-block" id="infoPesertaTabel"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total peserta pelatihan&emsp;&emsp;&nbsp;: </td>
                            <td>{{$total_peserta}}
                        </tr>
                        <tr>
                            <td>Total narasumber pelatihan : </td>
                            <td>{{$total_narasumber}}
                        </tr>
                        <tr>
                            <td>Total keseluruhan pelatihan : </td>
                            <td>{{$total}}
                        </tr>
                    </tbody>
                </table>
                <br><br>
            </div>
        </div>
    </div>
</div>
@stack('scripts')
@stop


@push('js')

    <script>
        var all = '';
        var table=$('#detailIhtTabel').DataTable({
            "columnDefs": [
                { "searchable": false,
                "orderable": false,
                "targets": [0,8]
                } //disable first and last column sorting
            ],
        });
        var table2=$('#totalTabel').DataTable({
            "paging":false,
            "searching": false,
            "ordering": false,
            "info":false,
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
            $('#tgl_pelaksanaan').val(data[2]);
            $('#nama_detail').val(data[3]);
            $('#gelombang').val(data[4]);
            $('#tempat').val(data[5]);
            $('#peserta').val(data[6]);
            $('#narasumber').val(data[7]);

            $('#editDetailForm').attr('action'+data[1]);
            $('#ihtDetailModalEdit').modal('show');
        });

        // script for show input text field Tempat
        $('select[name=tempat]').change(function(){
            if($(this).val() == 'Lainnya') {
                $('#otherType').show();
                $('#tempatInput').prop('disabled',false);
            }
            else {
                $('#otherType').hide();
                $('#tempatInput').prop('disabled',true);
            }
        });

        $('select[name=tempat]').change(function(){
            if(($(this).val() != 'Ruang Kelas A') && ($(this).val() != 'Ruang Kelas B') && ($(this).val() != 'GSG')) {
                $('#otherTypeEdit').show();
                $('#tempatInputEdit').prop('disabled',false);
            }
            else {
                $('#otherTypeEdit').hide();
                $('#tempatInputEdit').prop('disabled',true);
            }
        });

    </script>
@endpush

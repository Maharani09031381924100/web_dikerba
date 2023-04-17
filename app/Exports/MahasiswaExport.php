<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class MahasiswaExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {
        if (request()->startdate || request()->enddate) {
            $startdate = Carbon::parse(request()->startdate)->toDateTimeString();
            $enddate = Carbon::parse(request()->enddate)->toDateTimeString();
            // $iht = iht::whereBetween('tgl_mulai',[$startdate,$enddate])->whereBetween('tgl_selesai',[$startdate,$enddate])->get();
            return Mahasiswa::whereBetween('tgl_mulai',[$startdate,$enddate])->whereBetween('tgl_selesai',[$startdate,$enddate])->get();
        } else {
            return Mahasiswa::all();
        }
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Lengkap',
            'NIM',
            'Jenis Kelamin',
            'Instansi',
            'Fakultas',
            'Jurusan',
            'Program Studi',
            'Tingkat Pendidikan',
            'Semester',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Ruangan',
            'Keterangan',
            'Status Kelulusan'
        ];
    }
    protected $index = 0;
    public function map($mahasiswa): array
    {
        return [
            ++$this->index,
            $mahasiswa->nama_mahasiswa,
            $mahasiswa->nim,
            $mahasiswa->jk,
            $mahasiswa->univ->univ_name,
            $mahasiswa->fakul->fakul_name,
            $mahasiswa->jurusan->jurusan_name,
            $mahasiswa->prodi->prodi_name,
            $mahasiswa->tingkatpendidikan->tkpendidikan_name,
            $mahasiswa->semester,
            $mahasiswa->tgl_mulai,
            $mahasiswa->tgl_selesai,
            $mahasiswa->ruangan->ruangan_name,
            $mahasiswa->keterangan,
            $mahasiswa->Kelulusan
        ];
    }
}

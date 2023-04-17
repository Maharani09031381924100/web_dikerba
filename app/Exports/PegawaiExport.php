<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PegawaiExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return Pegawai::all();
    }
    public function headings(): array
    {
        return [
            '#',
            'No. Pegawai',
            'Email',
            'Nama',
            'Jenis Kelamin',
            'Tingkat Pendidikan',
            'Status Pekerjaan',
            'Status Jabatan',
            'Bidang/Bagian Tempat Bekerja'
        ];
    }
    protected $index = 0;
    public function map($pegawai): array
    {
        return [
            ++$this->index,
            $pegawai->no_pegawai,
            $pegawai->email_address,
            $pegawai->nama_pegawai,
            $pegawai->jk,
            $pegawai->tk_pddkan,
            $pegawai->status_pekerjaan,
            $pegawai->status_jabatan,
            $pegawai->bidang,
        ];
    }
}

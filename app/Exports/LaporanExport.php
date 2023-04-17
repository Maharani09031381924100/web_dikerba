<?php

namespace App\Exports;

use App\Models\Laporanpraktik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class LaporanExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
            return Laporanpraktik::whereBetween('tgl_mulai',[$startdate,$enddate])->whereBetween('tgl_selesai',[$startdate,$enddate])->get();
        } else {
            return Laporanpraktik::all();
        }
    }

    public function headings(): array
    {
        return [
            '#',
            'Instansi',
            'Fakultas',
            'Jurusan',
            'Program Studi',
            'Tingkat Pendidikan',
            'Tanggal Masuk',
            'Tanggal Keluar',
            'Jumlah',
            'Keterangan',
            'Status Kelulusan'
        ];
    }
    protected $index = 0;
    public function map($laporanpraktik): array
    {
        return [
            ++$this->index,
            $laporanpraktik->univ->univ_name,
            $laporanpraktik->fakul->fakul_name,
            $laporanpraktik->jurusan->jurusan_name,
            $laporanpraktik->prodi->prodi_name,
            $laporanpraktik->tingkatpendidikan->tkpendidikan_name,
            $laporanpraktik->tgl_mulai,
            $laporanpraktik->tgl_selesai,
            $laporanpraktik->jumlah,
            $laporanpraktik->keterangan,
            $laporanpraktik->Kelulusan
        ];
    }
}


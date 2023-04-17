<?php

namespace App\Exports;

use App\Models\Orientasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class OrientasiExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
            return Orientasi::whereBetween('tgl_orientasi',[$startdate,$enddate])->whereBetween('tgl_selesaiOrientasi',[$startdate,$enddate])->get();
        } else {
            return Orientasi::all();
        }
    }
    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'Jenis Kelamin',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Status Pegawai',
            'Pendidikan',
            'Asal Tempat Kerja'
        ];
    }
    protected $index = 0;
    public function map($orientasi): array
    {
        return [
            ++$this->index,
            $orientasi->name,
            $orientasi->jk,
            $orientasi->tgl_orientasi,
            $orientasi->tgl_selesaiorientasi,
            $orientasi->status_pegawai,
            $orientasi->pendidikan,
            $orientasi->asal
        ];
    }
}

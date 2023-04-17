<?php

namespace App\Exports;

use App\Models\Iht;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class IhtExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, ShouldAutoSize
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
            return iht::whereBetween('tgl_mulai',[$startdate,$enddate])->whereBetween('tgl_selesai',[$startdate,$enddate])->get();
        } else {
            return Iht::all();
        }
    }

    public function headings(): array
    {
        return [
            '#',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Jenis Kegiatan',
            'Nama Kegiatan',
            'Status Kegiatan',
        ];
    }
    protected $index = 0;
    public function map($iht): array
    {
        return [
            ++$this->index,
            Date::dateTimeToExcel($iht->tgl_mulai),
            Date::dateTimeToExcel($iht->tgl_selesai),
            $iht->jenis_kegiatan,
            $iht->nama_pelatihan,
            $iht->status,
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}

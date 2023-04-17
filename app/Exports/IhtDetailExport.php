<?php

namespace App\Exports;

use App\Models\Iht;
use App\Models\Detail_Iht;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IhtDetailExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Detail_Iht::query()->where('iht_id', $this->id)->get();
        // return Detail_Iht::all()->where(('iht_id'),'=',($iht['id']));;
    }

    public function headings(): array
    {
        return [
            '#',
            'Tanggal Pelaksanaan',
            'Detail Kegiatan',
            'Gelombang',
            'Tempat',
            'Jumlah Peserta',
            'Jumlah Narasumber',
        ];
    }
    protected $index = 0;
    public function map($detailIht): array
    {
        return [
            ++$this->index,
            Date::dateTimeToExcel($detailIht->tgl_pelaksanaan),
            $detailIht->nama_detail,
            $detailIht->gelombang,
            $detailIht->tempat,
            $detailIht->peserta,
            $detailIht->narasumber
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Jpl;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JplDetailExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $id;
    public function __construct($id, $jplId)
    {
        $this->id = $id;
        $this->jplId = $jplId;
    }

    public function collection()
    {
        return Jpl::where('jpl_id', $this->id)->where('pegawai_id', $this->jplId)->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Pegawai',
            'Kategori',
            'Nama Kegiatan',
            'Tempat',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'JPL',
            'No Sertifikat',
            'Penerbit Sertifikat',
        ];
    }
    protected $index = 0;
    public function map($jpl): array
    {
        return [
            ++$this->index,
            $jpl->pegawai->nama_pegawai,
            $jpl->kategori,
            $jpl->nama_kegiatan,
            $jpl->tempat,
            Date::dateTimeToExcel($jpl->tgl_mulai),
            Date::dateTimeToExcel($jpl->tgl_selesai),
            $jpl->jpl,
            $jpl->no_sertif,
            $jpl->penerbit,
        ];
    }
    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}


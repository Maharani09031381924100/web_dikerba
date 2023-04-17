<?php

namespace App\Exports;

use App\Models\Peserta_Iht;
use App\Models\Narasumber_Iht;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class IhtPesertaExport implements WithMultipleSheets{
    use Exportable;
    protected $id;
    protected $ihtId;
    public function __construct($id)
    {
        $this->id = $id;
    }

     public function sheets(): array
    {
        $sheets = [
            new PesertaIhtSheet($this->id),
            new NarasumberIhtSheet($this->id),
        ];


        return $sheets;
    }
}

class PesertaIhtSheet implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Peserta_Iht::query()->where('detail_iht_id', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Peserta',
            'Tempat Tugas',
        ];
    }
    protected $index = 0;
    public function map($pesertaIht): array
    {
        return [
            ++$this->index,
            $pesertaIht->nama_peserta,
            $pesertaIht->tempat_tugas,
        ];
    }
}

Class NarasumberIhtSheet implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Narasumber_Iht::query()->where('detail_iht_id', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Narasumber',
            'Instansi',
        ];
    }
    protected $index = 0;
    public function map($narasumberIht): array
    {
        return [
            ++$this->index,
            $narasumberIht->nama_narasumber,
            $narasumberIht->instansi,
        ];
    }
}

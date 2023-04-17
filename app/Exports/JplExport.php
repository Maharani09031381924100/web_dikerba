<?php

namespace App\Exports;

use App\Models\Jpl;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JplExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
        // $jpl = Jpl::query()->where('jpl_id', $this->id)->get();
        // $firstJpl = $jpl->first();
        // $this->totalJpl = DB::table('jpls')->where('jpl_id', $this->id)->where('pegawai_id', $firstJpl->pegawai_id)->sum('jpl');
    }

    public function collection()
    {
        \DB::statement("SET SQL_MODE=''");
        return Jpl::query()->where('jpl_id', $this->id)->groupBy('pegawai_id')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Pegawai',
            'Total JPL',
        ];
    }
    protected $index = 0;
    public function map($jpl): array
    {
        $totalJpl = DB::table('jpls')->where('jpl_id', $this->id)->where('pegawai_id', $jpl->pegawai_id)->sum('jpl');
        return [
            ++$this->index,
            $jpl->pegawai->nama_pegawai,
            $totalJpl
        ];
    }
}

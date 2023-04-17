<?php

namespace App\Exports;

use App\Models\Tna;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TnaExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
        return Tna::query()->where('tna_id', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Email',
            'Nama',
            'Umur',
            'Jenis Kelamin',
            'Tingkat Pendidikan',
            'Status Pekerjaan',
            'Status Jabatan',
            'Lama Bekerja di Rumah Sakit',
            'Lama Bekerja di Tempat Sekarang',
            'Bidang/Bagian Tempat Bekerja',
            'Kompetensi yang wajib dimiliki berdasarkan Tupoksi',
            'Masalah yang dihadapi untuk pengembangan capaian kompetensi (diisi berdasarkan poin sebelumnya)',
            'Pelatihan/IHT/seminar/workshop/teknis yang telah diikuti dalam 2 tahun terakhir (online/offline)',
            'Pelatihan/IHT/Prioritas untuk Pengembangan Kompetensi sesuai Tupoksi'
        ];
    }
    protected $index = 0;
    public function map($tna): array
    {
        return [
            ++$this->index,
            $tna->pegawai->email_address,
            $tna->pegawai->nama_pegawai,
            $tna->umur,
            $tna->pegawai->jk,
            $tna->pegawai->tk_pddkan,
            $tna->pegawai->status_pekerjaan,
            $tna->pegawai->status_jabatan,
            $tna->lama_kerja_rs,
            $tna->lama_kerja_skrg,
            $tna->pegawai->bidang,
            $tna->kompetensi,
            $tna->masalah,
            $tna->pelatihan_2_thn,
            $tna->pelatihan_tupoksi,
        ];
    }
}

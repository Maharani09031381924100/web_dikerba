<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporanpraktik extends Model
{
    use HasFactory;
    protected $table = 'laporanpraktiks';

    protected $primaryKey = 'id';

    protected $fillable = [
        'univ_id',
        'fakul_id',
        'jurusan_id',
        'prodi_id',
        'tkpendidikan_id',
        'tgl_mulai',
        'tgl_selesai',
        'jumlah',
        'keterangan',
        'Kelulusan',

    ];

    public function univ()
    {
        return $this->belongsTo(Univ::class, 'univ_id', 'iduniv');
    }
    public function fakul()
    {
        return $this->belongsTo(Fakul::class, 'fakul_id', 'idfakul');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'idjurusan');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'idprodi');
    }
    public function tingkatpendidikan()
    {
        return $this->belongsTo(Tingkatpendidikan::class, 'tkpendidikan_id', 'idtkpendidikan');
    }

}

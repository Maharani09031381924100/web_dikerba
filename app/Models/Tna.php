<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tna extends Model
{
    use HasFactory;
    protected $fillable=['tna_id','pegawai_id','umur', 'lama_kerja_rs', 'lama_kerja_skrg', 'kompetensi', 'masalah', 'pelatihan_2_thn', 'pelatihan_tupoksi'];
    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    public function tnaUtama(){
        return $this->belongsTo(TnaUtama::class, 'tna_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jpl extends Model
{
    use HasFactory;
    protected $fillable=['jpl_id','pegawai_id','kategori','nama_kegiatan','tempat','tgl_mulai', 'tgl_selesai', 'jpl', 'no_sertif', 'penerbit'];
    protected $dates = ['tgl_mulai','tgl_selesai'];
    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    public function jplUtama(){
        return $this->belongsTo(JplUtama::class, 'jpl_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iht extends Model
{
    use HasFactory;
    protected $fillable = ['tgl_mulai', 'tgl_selesai', 'jenis_kegiatan', 'nama_pelatihan', 'status'];
    protected $dates = ['tgl_mulai','tgl_selesai'];


    public function detail_ihts(){
        return $this->hasMany(Detail_Iht::class, 'iht_id');
    }
}

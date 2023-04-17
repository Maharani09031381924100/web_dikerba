<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta_Iht extends Model
{
    use HasFactory;
    protected $table='peserta_ihts';
    protected $fillable=['detail_iht_id', 'nama_peserta', 'tempat_tugas'];
    public function detail_iht(){
        return $this->belongsTo(Detail_Iht::class, 'detail_iht_id');
    }
}

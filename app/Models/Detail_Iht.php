<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Iht extends Model
{
    use HasFactory;
    protected $table='detail_ihts';
    protected $fillable=['iht_id', 'tgl_pelaksanaan', 'nama_detail', 'gelombang', 'tempat', 'peserta', 'narasumber'];
    protected $dates=['tgl_pelaksanaan'];
    public function iht(){
        return $this->belongsTo(Iht::class, 'iht_id');
    }
    public function peserta_ihts(){
        return $this->hasMany(Peserta_Iht::class, 'detail_iht_id' );
    }
    public function narasumber_ihts(){
        return $this->hasMany(Narasumber_Iht::class, 'detail_iht_id' );
    }
}

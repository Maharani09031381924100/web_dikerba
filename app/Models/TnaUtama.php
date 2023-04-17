<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TnaUtama extends Model
{
    use HasFactory;
    protected $fillable=['tahun'];


    public function tnas(){
        return $this->hasMany(Tna::class, 'tna_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JplUtama extends Model
{
    use HasFactory;
    protected $fillable=['tahun'];

    public function jpls(){
        return $this->hasMany(Jpl::class, 'tna_id');
    }
}

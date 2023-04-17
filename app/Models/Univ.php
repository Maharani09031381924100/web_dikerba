<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Univ extends Model
{
    use HasFactory;

    protected $primaryKey = 'iduniv';

    protected $fillable = [
        'univ_name',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'univ_id', 'iduniv');
    }
}

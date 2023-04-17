<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkatpendidikan extends Model
{
    use HasFactory;
    protected $primaryKey = 'idtkpendidikan';

    protected $fillable = [
        'tkpendidikan_name',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'tkpendidikan_id', 'idtkpendidikan');
    }
}

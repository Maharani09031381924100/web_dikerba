<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $primaryKey = 'idruangan';

    protected $fillable = [
        'kode',
        'ruangan_name',
    ];

    public function ruangans()
    {
        return $this->hasMany(Ruangan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orientasi extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 'admin';

    protected $table = 'orientasis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'jk',
        'tgl_orientasi',
        'tgl_selesaiorientasi',
        'status_pegawai',
        'pendidikan',
        'asal',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

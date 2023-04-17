<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $primaryKey = 'idprodi';

    protected $fillable = [
        'prodi_name',
    ];
}

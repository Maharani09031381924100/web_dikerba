<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakul extends Model
{
    use HasFactory;
    protected $primaryKey = 'idfakul';

    protected $fillable = [
        'fakul_name',
    ];
}

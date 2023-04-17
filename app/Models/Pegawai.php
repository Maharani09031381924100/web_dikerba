<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'no_pegawai';
    protected $fillable=['no_pegawai','email_address', 'nama_pegawai', 'jk', 'tk_pddkan', 'status_pekerjaan','status_jabatan','bidang'];
    public function tnas(){
        return $this->hasMany(Tna::class );
    }
    public function jpls(){
        return $this->hasMany(Jpl::class );
    }
}

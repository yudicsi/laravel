<?php

namespace App\_laravel\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $fillable = [ 'nama_kelas', 'jurusan', 'jumlah_siswa' ];
    protected $table = 'kelas';
}    


<?php

namespace App\_laravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matpel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [ 'nama_matpel', 'status', 'bobot' ,'warna'];
    protected $table = 'matpel';
    protected $primaryKey = 'id';
    public function gurus()
    {
        return $this->belongsToMany(guru::class,'guru_matpel');
    }    


}

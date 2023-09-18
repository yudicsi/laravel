<?php

namespace App\_laravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable = [ 'nama', 'alamat', 'tanggal_lahir', 'longitude' ,'longitude','latitude','keterangan', 'status'];
    protected $table = 'customer';
}    

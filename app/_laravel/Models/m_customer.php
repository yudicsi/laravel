<?php

namespace App\_laravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_customer extends Model
{
    use HasFactory;
    protected $fillable = [ 'nama', 'keterangan', 'status'];
    protected $table = 'm_customer';
}    

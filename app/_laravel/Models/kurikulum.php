<?php

namespace App\_laravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kurikulum extends Model
{
    use HasFactory;
    protected $fillable = [ 'Tingkat', 'jurusan'];
    protected $table = 'kurikulum';
    protected $primaryKey = 'id';

}    

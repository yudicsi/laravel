<?php

namespace App\_laravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;
    protected $fillable = [ 'Nama', 'tambahan', 'JJM', 'Total_JJM' ];
    protected $table = 'guru';

    public function matpels()
    {
        return $this->belongsToMany(matpel::class,'guru_matpel');
    }    

}    


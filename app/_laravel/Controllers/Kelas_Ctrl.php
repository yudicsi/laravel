<?php

namespace App\_laravel\Controllers;
use App\__aaa\Controllers\mstr_Controller;
use Illuminate\Support\Str;
use App\_laravel\Models\kelas;
use Illuminate\Database\Eloquent\Model;

class Kelas_Ctrl extends mstr_Controller
{

   function __construct()
   {
      parent::__construct();        
      $this->model=new kelas;
   }

}

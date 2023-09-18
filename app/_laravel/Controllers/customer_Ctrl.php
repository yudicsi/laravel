<?php

namespace App\_laravel\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\db;
use Illuminate\Database\Eloquent\Model;
use App\__aaa\Controllers\mstr_Controller;
use App\_laravel\Models\customer;

class customer_Ctrl extends mstr_Controller
{

   function __construct()
   {
      parent::__construct();        
      $this->model=new customer;
   }

}


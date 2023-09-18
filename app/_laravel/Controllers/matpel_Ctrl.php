<?php
namespace App\_laravel\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\__aaa\Controllers\mstr_Controller;
use App\_laravel\Models\matpel;


class matpel_Ctrl extends mstr_Controller
{

   function __construct()
   {
      parent::__construct();    
      $this->model=new matpel;
      $this->head ='MATA PELAJARAN';
      $this->tbl_view = $this->dir_view.$this->tbl_view;
   }

}

<?php
namespace App\_sdamada\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\db;
use App\__aaa\Controllers\User_Ctrl;
use App\__aaa\Controllers\mstr_Controller;



class Sales2_Ctrl extends User_Ctrl
{

   public $Supl;

   function __construct()
   {
      $_SESSION['Aplication']=$_SESSION['APP_PATERN'];
      $this->file_db=$_SESSION['APP_PATERN'].'.user1';
      $ss='Aplication, UserId, UserName, KdSupl, UserAdd, DateAdd, UserEdit, DateEdit, id';
      $this->model=DB::table($this->file_db)->selectRaw($ss)->where('Aplication',$_SESSION['APP_PATERN']);
      $this->primaryKey = 'id,DateAdd';

      $this->fillable = [
         'Aplication',
         'UserId',
         'UserPassword',
         'UserName',
         'email',
         'KdSupl',
         'UserAdd',
         'DateAdd',
         'UserEdit',
         'DateEdit',
         'id',
         ];

      mstr_Controller::__construct();     
      $ss=url()->current();       
      $ss=str_replace(Str::afterLast($ss, '/'),'Suppl-1',$ss);
      $this->Supl=new \suppl_Ctrl;
	  $this->Supl->tbl_Name=$ss;
      $this->head='SALES';

   }   


}

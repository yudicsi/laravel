<?php
namespace App\_gsmnew\Controllers\Sales2_Ctrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\db;
use App\__stock\Controllers\suppl_Ctrl;
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
      $this->tbl_view = 'PATERN::sales2_view';
      $this->Supl=new suppl_Ctrl;

   }   


}

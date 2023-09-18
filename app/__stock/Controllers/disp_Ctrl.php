<?php
namespace App\__stock\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\db;
use App\__aaa\Controllers\mstr_Controller;

class disp_Ctrl extends mstr_Controller
{
   function __construct() {
      parent::__construct($_SESSION['APP_PATERN'].'.display','grup','','STOCK::');     
   }   
   
   public function store(Request $request,$fieldContent='') {
    $result = parent::store($request);     
    if (IsEmptyObj($result)) return $result;
    $id=DB::select('select LAST_INSERT_ID() as idx')[0]->idx;
    $getdata=$result->getdata();
    $arr=objectToArray($getdata->data);
    $arr['Kode']=$id;
    $getdata->data=json_decode(json_encode($arr));
    $result->setdata($getdata);
    return $result;
   }
}



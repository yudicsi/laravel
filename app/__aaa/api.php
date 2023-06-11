<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\__aaa\Controllers\User_Ctrl;
use App\__aaa\Controllers\mstr_Controller;
use App\__stock\Controllers\Langg_Ctrl;

class suppl_Ctrl extends Langg_Ctrl
{
   function __construct() {
      parent::__construct(env('APP_NAME').'.supplier');     
   }   
}

class cust_Ctrl extends Langg_Ctrl
{
   function __construct() {
      parent::__construct(env('APP_NAME').'.Customer');     
   }   
}

class grup_Ctrl extends mstr_Controller
{
   function __construct() {
      parent::__construct($_SESSION['APP_PATERN'].'.group1','grup','GROUP','STOCK::');     
   }   
}
class rak_Ctrl extends mstr_Controller
{
   function __construct() {
      parent::__construct(env('APP_NAME').'.rak','grup','RAK','STOCK::');     
   }   
}
class disp_Ctrl extends mstr_Controller
{
   function __construct() {
      parent::__construct($_SESSION['APP_PATERN'].'.display','disp','DISPLAY','STOCK::');     
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


Route::get('login', function() {
    return response()->json(['message' => 'Unauthorized.'], 401);
});


Route::get('/XXX', [function (Request $request) {
  return redirect('~');
  echo '<BR><BR><BR><BR><BR><BR><H1><CENTER>HTTP 404 Not Found</H1></CENTER>';
  echo '<P><CENTER>The requested URL [URL] was not found on this server</CENTER></P>';
//      return response()->json(['message' => 'Unauthorized.', 'code'=>401]);
}]);

Route::get('AA', function (Request $request) {
  return 'COBA TULIS';
});

Route::get('logout', [RegisterController::class, 'logout']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('user_accessible')->group(function () {
  //	Route::middleware('auth:api')->group(function () {
  /*
  Route::get('UserX', [user_Ctrl::class, 'GetSelect']);
  */
  Route::get('user', function (Request $request) {
    return (new User_Ctrl)->GetRecords($request,'','UserId,UserName,UserLevel,email');
  });
  Route::get('User-1', [user_Ctrl::class, 'index']);
  Route::get('User', [user_Ctrl::class, 'index']);
  Route::post('user', [user_Ctrl::class, 'store']);
  Route::put('user', [user_Ctrl::class, 'update']);
  Route::delete('user', [user_Ctrl::class, 'destroy']);
  
  Route::get('grup', function (Request $request) {
    return (new grup_Ctrl)->GetRecords($request,'','Kode,Keterangan');
  });
  Route::get('Grup-1', [grup_Ctrl::class, 'index']);
  Route::get('Grup', [grup_Ctrl::class, 'index']);
  Route::post('grup', [grup_Ctrl::class, 'store']);
  Route::put('grup', [grup_Ctrl::class, 'update']);
  Route::delete('grup', [grup_Ctrl::class, 'destroy']);
 
  Route::get('rak', function (Request $request) {
    return (new rak_Ctrl)->GetRecords($request,'','Kode,Keterangan');
  });
  Route::get('Rak-1', [rak_Ctrl::class, 'index']);
  Route::get('Rak', [rak_Ctrl::class, 'index']);
  Route::post('rak', [rak_Ctrl::class, 'store']);
  Route::put('rak', [rak_Ctrl::class, 'update']);
  Route::delete('rak', [rak_Ctrl::class, 'destroy']);

  Route::get('disp', function (Request $request) {
    return (new disp_Ctrl)->GetRecords($request,'','Kode,Nama');
  });
  Route::get('Disp-1', [disp_Ctrl::class, 'index']);
  Route::get('Disp', [disp_Ctrl::class, 'index']);
  Route::post('disp', [disp_Ctrl::class, 'store']);
  Route::put('disp', [disp_Ctrl::class, 'update']);
  Route::delete('disp', [disp_Ctrl::class, 'destroy']);

  Route::get('suppl', function (Request $request) {
    $sup=new suppl_Ctrl;
    return $sup->GetRecords($request,'',$sup->fillable,true,$sup->file_db);
  });
  Route::get('Suppl-1', [suppl_Ctrl::class, 'index']);
  Route::get('Suppl', [suppl_Ctrl::class, 'index']);
  Route::post('suppl', [suppl_Ctrl::class, 'store']);
  Route::put('suppl', [suppl_Ctrl::class, 'update']);
  Route::delete('suppl', [suppl_Ctrl::class, 'destroy']);
  
  Route::get('cust', function (Request $request) {
    $sup=new cust_Ctrl;
    return $sup->GetRecords($request,'',$sup->fillable,true,$sup->file_db);
  });
  Route::get('Cust-1', [cust_Ctrl::class, 'index']);
  Route::get('Cust', [cust_Ctrl::class, 'index']);
  Route::post('cust', [cust_Ctrl::class, 'store']);
  Route::put('cust', [cust_Ctrl::class, 'update']);
  Route::delete('cust', [cust_Ctrl::class, 'destroy']);
  


  });


/*

Route::middleware(['auth:api','user_accessible'])->group(function () {
  // Route::get('User', [user_Ctrl::class, 'index']);

});

*/
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\db;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use vendor\mobiledetect\mobiledetectlib\src\MobileDetect;

//include str_replace("\\","/",base_path('app/__aaa/fungsi.php'));

 
Route::get('AA', function (Request $request) {
//   echo url()->current();
//   window.location.href.replace('AA','B');
//   echo 'window.location.replace("http://localhost:8000/menu");';
$detect = new Detection\MobileDetect;
 
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) 
   echo 'mobile device (phones or tablets).';
else
echo 'deskc';

});

Route::get('B', function (Request $request) {
   ECHO 'COBA TAMPIL';
});

Route::get('A', function (Request $request) {
   echo '<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>';
   
   echo '<button onclick="myFunction()">Click me</button>';

   echo '<p id="demo"></p>';

   echo '<script>

   function myFunction() {
	$.ajax({
      type: "GET",
      dataType : "html",
      url: "http://localhost:8000/AA",
      success: (response) => {
         window.location.href="http://localhost:8000/menu";}
      });
   }
    </script>';   
});


if (file_exists($_SESSION['APP_DIR'].'/Company.json')) {    

   Route::get('login',function (Request $request) {
     if (!request()->ajax()) return view('AAA::login',['kdcab' => $_SESSION['APP_KDCAB']]);        
   });

   Route::post('login2', function (Request $request) {
      unset($_SESSION['UserAdd']);
      unset($_SESSION['USER_LVL']);
      unset($_SESSION['APP_USER']);
      unset($_SESSION['ID_REQ']);
      unset($_SESSION['key']);
      $result=UserLevel($request); 
      if ($_SESSION['USER_LVL']==0 || $result->status()!=202) {
         return 0;
      }
      return $result;
   });

   Route::get('/menu//', function (Request $request) {
      if (NotOKUser() || !$request->has('key') || !IsToken(2,$request)) return redirect('NaN');
      if (strtoupper($_SESSION['UserAdd'])!='CSI') {
         $aa='Select MenuCaption, MenuNumber, url from '.$_SESSION['APP_PATERN'].'.flmenu A, '. 
         $_SESSION['APP_PATERN'].'.author B where A.Aplication=B.Aplication AND A.MenuName=B.MenuName AND A.Aplication="'.
         $_SESSION['APP_PATERN'].'" AND B.UserId="'.$_SESSION['UserAdd'].'" AND B.Otoritas=1 order by MenuNumber /* LIMIT 5 */';
         $arr = db::select($aa); }
      else {
         $aa='Select MenuCaption, MenuNumber, url from '.$_SESSION['APP_PATERN'].'.flmenu A where A.Aplication="'.
         $_SESSION['APP_PATERN'].'" order by MenuNumber';
         $arr = db::select($aa);
      }
      return view('AAA::MainMenu',['arr' => json_encode($arr)]);
      //$('meta[name=req_ID]').attr('content');
   });

}
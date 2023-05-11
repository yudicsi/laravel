<?php
use Illuminate\Support\Facades\db;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\__aaa\Controllers\API\RegisterController;

function NotOKUser() {
return (empty($_SESSION['APP_USER']) || empty($_SESSION['ID_REQ']));
}

function IsToken($mode,Request $request) {
  $result=$request->has('id_req');
  if ($mode==1) return $result;
  $ss=DB::table($_SESSION['APP_PATERN'].'.tokens')->where('req_id',$request->id_req)->first();
  $result=$result && $ss->id==$request->id;
  if ($mode==2) return $result;
  return $result && $ss->token==$request->token;
} 


function UserLevel(Request $request)
{
  try
  {
    $User = DB::table($_SESSION['APP_PATERN'] . '.User1')
    ->whereRaw('UserId=? and UserPassword=' . $_SESSION['APP_PATERN'] . '.SF_StrToCode(?)', [$request->name,$request->password]);
    if (!$User) return 0;
    $_SESSION['USER_LVL']=$User->value('UserLevel');
    $request->merge(['email' => $User->value('email')]);
    Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    $user = Auth::user(); 
    if (!$user) return 0;
    if (!$user->tokens->where('name', $user->idx.'_'.$user->name.'_'.$_SESSION['APP_NAME'].'_'.$_SESSION['APP_KDCAB'].'_register')->first()) return 0;
    $_SESSION['APP_USER']=$user->idx.'_'.$user->name.'_'.gethostbyaddr($_SERVER['REMOTE_ADDR']).
    '_'.$_SESSION['APP_NAME'].'_'.$_SESSION['APP_KDCAB'];
    $ss=(new RegisterController);
    $s=$ss->login($request);
    $_SESSION['UserAdd']=$request->name;
    if ($s->getData()->message!=200) return 0;
    $request->session()->put($_SESSION['USER_LVL']);
    //$ss->logout();
    return $s;
  }
  catch(Throwable $e)
  {
    $request->session()->put('USER_LVL',0);
  }
}


function DeleteRecord($File, $Field='', $KeyValue=[])
{
  $ss='Delete from '.$File;
  if (empty($Field)) 
    $affected = DB::delete($ss);  
  else {
    if (substr_count($Field,',')>0) {
       $aa=explode(',',$Field);
       $Field.=implode("=?, ",$aa);
    }
    $Field.='=?';
    $affected = DB::delete($ss.' Where '.$Field,$KeyValue);
  }
  return $affected;
}  

function Arr2Lower(array $arr) {
  $arr_ = array();   
  foreach ($arr as $row) {
    array_push($arr_,strtolower($row));
  }
  return $arr_;
}

function delArrValues(array $arr, array $remove, $ignore_case=false) {
  if (!$ignore_case)
     return array_filter($arr, fn($e) => !in_array($e, $remove));
  else {
    $arr_ = Arr2Lower($arr);
    $remove_ = Arr2Lower($remove);
    return array_filter($arr_, fn($e) => !in_array($e, $remove_));
  }
};

function getKeys($tbl)
{
  $Result = DB::select("SHOW INDEXES FROM ".$tbl." WHERE Key_name = 'PRIMARY'");    
  $Keys = '';
  foreach ($Result as $row) {
    $Keys.=(!empty($Keys)?',':'').$row->Column_name;
  }
  return $Keys;
}


function getFields($tbl)
{
  $Result = DB::select("SHOW COLUMNS FROM ".$tbl); 
  $field = array();   
  foreach ($Result as $row) {
    array_push($field,$row->Field);
  }
  return $field;
}


function UpdateRecord(Request $request,$File, $Field, $where='')
{
  try {
    if (substr_count($where,',')==0) 
        $whereArrData[$where] = $request->input($where);
    else {
      $aa=explode(',',$where);
      $whereArrData = array();
      foreach ($aa as $value) {
        $whereArrData[$value]=$request->input($value);
      }   
    }
    if (substr_count($Field,',')==0) 
       $ArrData[$Field] = $request->input($Field);
    else {
      $aa=explode(',',$Field);
      foreach ($aa as $value) {
        $ArrData[$value] = $request->input($value);
      }   
    }
    DB::beginTransaction(); //start transaction
    $affected = DB::table($File)->where(array([$whereArrData]))->update($ArrData);    
    DB::commit();}
  catch(Exception|Error $exception) { 
    DB::rollBack();
    $affected = -1;
  } 
  return $affected;
};


function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', substr($tanggal,0,10));
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
  return $pecahkan[2] . '-' . $bulan[ (int)$pecahkan[1] ] . '-' . $pecahkan[0];
}

function tgl_indo2($tanggal){
	$bulan = array (
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agus',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', substr($tanggal,0,10));
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
  return $pecahkan[2] . '-' . $bulan[ (int)$pecahkan[1] ] . '-' . $pecahkan[0];
}

function incprd($prd,$step=1) {
  $iMonth=substr($prd,-2)+$step;
  if ($iMonth>0) {
    $yy=($iMonth>12)?intval($iMonth/12):0;
    $iYear=substr($prd,0,4)+$yy;
    if ($iMonth!=12) $iMonth=fmod($iMonth,12);}
  else {
    $iYear=substr($prd,0,4)-1;
    $yy=($iMonth<=-12)?intval($iMonth/12):0;
    $iYear=$iYear+$yy;
    $iMonth=fmod($iMonth,12);
    $iMonth=12+$iMonth;
  }
  $s=($iMonth<10)?'-0':'-';
  return $iYear.$s.$iMonth;
}

function ToTableName($Trx = '', $prd = '', $Db = '') {
  if (is_null($Trx)) return '';
  if (substr_count($Trx,'.')>0) return $Trx;
  $prd=substr($prd, 0, 7);
  $File=$Trx;
  if (!empty($Db)) {$Dbx = $Db;} 
  $bln = '';
  $YY = '';
  $ss=substr($Trx,-1,1);
  $i=substr_count($Trx,'_');
  if (empty($prd)) {
    if ($i>0) {
      if($ss=='_') $bln = substr($_SESSION['APP_PRD'], -2);
      $YY = substr($_SESSION['APP_PRD'], 0, 4); 
      if (empty($Dbx)) $Dbx = $_SESSION['APP_DB'];} 
    else {
      if (empty($Dbx)) $Dbx=$_SESSION['APP_PATERN'];}}
  else {
    if (gettype($prd) == "string") {
      $bln = substr($prd, -2);
      $YY = substr($prd, 0, 4);}
    else {
      $bln = date_format($prd, "m");
      $YY = date_format($prd, "Y");
    }
  }
  if (empty($Dbx)) {
    $Dbx = $_SESSION['APP_PATERN'];    
    if (!empty($YY)) $Dbx .= '_'.$_SESSION['APP_KDCAB'].$YY;
  }
  if ($ss='_') $File .=$bln;
  return $Dbx . '.' . $File;
}


function left($str, $length)
{
  return substr($str, 0, $length);
}

function right($str, $length)
{
  return substr($str, -$length);
}

function has_letter($x)
{
  if (preg_match("/[\p{L}]/u", $x))
  {
    return true;
  }
  return false;
}

function has_number($x)
{
  if (preg_match("/[\p{N}]/u", $x))
  {
    return true;
  }
  return false;
}

function StrToCode($Str)
{
  $l = strlen($Str);
  $Dest = '';
  $j = 1;
  for ($x = $l;$x > 0;$x--)
  {
    $Ch = substr($Str, $x - 1, 1);
    $Dest .= chr(ord($Ch) + $j + 10);
    $j += 1;
  }
  return $Dest;
}

function CodeToStr($Str)
{
  $l = strlen($Str);
  $Dest = '';
  for ($x = $l;$x > 0;$x--)
  {
    $Ch = substr($Str, $x - 1, 1);
    $Dest .= chr(ord($Ch) - $x - 10);
  }
  return $Dest;
}

function GetRecs(Request $request,$file_db,$field='')
{
   if (substr_count($field,',')==0) {
      $aa=$request->input($field);
      if (is_null($aa) && array_key_exists($field, $_REQUEST)) $aa=$_REQUEST[$field];
      if (strtoupper($aa)=='$_SESSION' && $request->session()->has($_SESSION[$field])) $aa=$_SESSION[$field];
      if ($file_db instanceof \Illuminate\Database\Eloquent\Model) {
        if (empty($field))
          $affected = $file_db;
        else
          $affected = $file_db->where(Str::afterLast($field, '~'),$aa);
        }
      else {
        if (empty($field))
          $affected = DB::table($file_db); 
        else
          $affected = DB::table($file_db)->where(Str::afterLast($field, '~'),$aa);
      };}
   else {     
      $arr_field=array();
      $array=explode(",",$field);
      foreach($array as $value) {
         $aa=$request->input($value);
         if (is_null($aa) && array_key_exists($value, $_SESSION)) $aa=$_SESSION[$value];
         if (!is_null($aa)) array_push($arr_field,array(Str::afterLast($value, '~'),$aa));
      }
      if ($file_db instanceof \Illuminate\Database\Eloquent\Model) 
         $affected = $file_db->where($arr_field);
      else
         $affected = DB::table($file_db)->where($arr_field);
   }
   return $affected;
}

function testRegister(){
  //User's data
  $data = [
      'email' => 'test@gmail.com',
      'name' => 'Test',
      'password' => 'secret1234',
      'password_confirmation' => 'secret1234',
  ];
  //Send post request
  $response = $this->json('POST',route('api.register'),$data);
  //Assert it was successful
  $response->assertStatus(200);
  //Assert we received a token
  $this->assertArrayHasKey('token',$response->json());
  //Delete data
  User::where('email','test@gmail.com')->delete();
}


function sendResponse($data, $result, $message = '', $code = 200)
{
   $response = [
        'success' => $result,
        'data'    => $data,
        'message' => $message,
    ];
    return response()->json($response, $code);
}

function num2rom($num)  
{ 
    // Be sure to convert the given parameter into an integer
    $n = intval($num);
    $result = ''; 
     // Declare a lookup array that we will use to traverse the number: 
    $lookup = array(
        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
    ); 
    foreach ($lookup as $roman => $value)  
    {
        // Look for number of matches
        $matches = intval($n / $value); 
         // Concatenate characters
        $result .= str_repeat($roman, $matches); 
         // Substract that from the number 
        $n = $n % $value; 
    } 
    return $result; 
} 

function rom2num($roman){
  $roman = strtoupper($roman);
  $romans = [
      'M' => 1000,
      'CM' => 900,
      'D' => 500,
      'CD' => 400,
      'C' => 100,
      'XC' => 90,
      'L' => 50,
      'XL' => 40,
      'X' => 10,
      'IX' => 9,
      'V' => 5,
      'IV' => 4,
      'I' => 1,
  ];
  $result = 0;
  foreach ($romans as $key => $value) {
      while (strpos($roman, $key) === 0) {
          $result += $value;
          $roman = substr($roman, strlen($key));
      }
  }
  return $result;
}

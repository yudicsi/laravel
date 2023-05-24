<?php
namespace App\__aaa\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\db;
use App\__aaa\Controllers\mstr_Controller;
use App\__aaa\Controllers\API\RegisterController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class User_Ctrl extends mstr_Controller
{
   function __construct()
   {
 //     $_SESSION['UserAdd']='CSI';
//      $this->middleware('auth');
      //$_SESSION['UserAdd']='CSI';
      $_SESSION['Aplication']=$_SESSION['APP_PATERN'];
      if (!empty($_GET['key'])) $_SESSION['key']=$_GET['key'];
      $this->file_db=$_SESSION['APP_PATERN'].'.user1';
      $ss='Aplication, UserId, '.$_SESSION['APP_PATERN'].'.SF_CodeToStr(userpassword) as UserPassword,'.
      'UserName, UserLevel,  email, UserAdd, DateAdd, UserEdit, DateEdit, id';
      $this->model=DB::table($this->file_db)->selectRaw($ss)->where('Aplication',$_SESSION['APP_PATERN']);
      $this->primaryKey = 'id,DateAdd';

      $this->fillable = [
         'Aplication',
         'UserId',
         'UserPassword',
         'UserName',
         'email',
         'UserLevel',
         'UserAdd',
         'DateAdd',
         'UserEdit',
         'DateEdit',
         'id',
         ];
      parent::__construct();     
      $this->tbl_view = 'AAA::user_view';
   }   

   public function BeforeSave(Request $request) {
      $request->merge(['name' => $request->input('UserId')]);
      $request->merge(['password' => $request->input('UserPassword')]);
      date_default_timezone_set('Asia/Jakarta');
      $request->merge(['DateEdit' => date("Y-m-d H:i:s")]);
}

   public function GetSelect() {
      return $this->model->get();
    }

   public function store(Request $request,$fieldContent='') {
      $this->BeforeSave($request);
      $result = parent::store($request);     
      if (IsEmptyObj($result)) return $result;
      $id=$result->getData()->data->id;
      $dt=$result->getData()->data->DateAdd;
      DB::statement('update '.$this->file_db.' set UserPassword='.$_SESSION['APP_PATERN'].'.SF_StrToCode("'.$request->input('UserPassword').'") '.
      'where Aplication = "'.$_SESSION['APP_PATERN'].'" AND id=? AND DateAdd=?',[$id,$dt]);
      $request->merge(['idx' =>$id.'_'.$dt]);
      (new RegisterController)->register($request);
      return $result;
   }

   public function update(Request $request,$field='',$fieldContent='')
   {
      $this->BeforeSave($request);
      $result=parent::update($request);     
      if (IsEmptyObj($result)) return $result;
      DB::unprepared('update '.$this->file_db.' set UserPassword='.$_SESSION['APP_PATERN'].'.SF_StrToCode("'.$request->input('UserPassword').'") '.
      'where Aplication = "'.$_SESSION['APP_PATERN'].'" AND id='.$request->input('~id').' AND DateAdd="'.$request->input('~DateAdd').'"');
      $ss=$request->input('~id').'_'.$request->input('~DateAdd');
      $request->merge(['idx' => $ss]);
      Auth::attempt(['email' => $request->email, 'password' => $request->password]);
      $user = Auth::user(); 
      $ss=$request->only('idx','name', 'email', 'password');
      $ss['password']=Hash::make($ss['password']);
      if (!$user) {
         $user=GetRecs($request,$_SESSION['APP_PATERN'].'.users','idx');
         User::create($ss); 
         (new RegisterController)->register($request);}
      else {
         $user->update($ss);
         if (!$user->tokens->where('idx', $request->idx)->first()) (new RegisterController)->register($request);
      }
      return $result;
   }

   public function destroy(Request $request)
   {
      try{
         DB::beginTransaction();
         $ss = parent::destroy($request);     
         if (IsEmptyObj($ss)) return $ss;
         $res=DB::table($_SESSION['APP_PATERN'].'.users')->where('idx', $request->id.'_'.$request->DateAdd);
         if ($res && $res->count()>0) { 
            if (!$res->delete()) return sendResponse(422,'Terjadi Error saat hapus data, OK !!!','',$res);
         }
         DB::commit();
         return sendResponse(200,'Data telah dihapus, OK !!!','',$res,'UserId,UserName,UserLevel,email');}
      catch(\Exception $e){
          DB::rollback();
          return sendResponse(422,'Terjadi Error saat delete data, OK !!!','',$e);
      }
   }

   

}

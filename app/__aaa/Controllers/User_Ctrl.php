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
      $_SESSION['Aplication']=$_SESSION['APP_PATERN'];
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

   protected function GetSelect() {
      return $this->model->get();
    }

   public function BeforeSave(Request $request) {
      $request->merge(['name' => $request->input('UserId')]);
      $request->merge(['password' => $request->input('UserPassword')]);
      date_default_timezone_set('Asia/Jakarta');
      $_SESSION['DateEdit']=date("Y-m-d H:i:s");
}

   public function store(Request $request,$fieldContent='') {
      $this->BeforeSave($request);
      $result = parent::store($request);     
      DB::unprepared('update '.$this->file_db.' set UserPassword='.$_SESSION['APP_PATERN'].'.SF_StrToCode("'.$request->input('UserPassword').'") '.
      'where Aplication = "'.$_SESSION['APP_PATERN'].'" AND id='.$_SESSION[$this->file_db.'_id']);
      $request->merge(['idx' => $_SESSION[$this->file_db.'_id'].'_'.$_SESSION['DateAdd']]);
      (new RegisterController)->register($request);
      return $result;
   }

   public function update(Request $request,$field='',$fieldContent='')
   {
      $this->BeforeSave($request);
      $result = parent::update($request);     
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

   protected function edit(Request $request,$field='',$First=true)
   {
      $affected=$this->GetRecords($request,$field);
      if ($First) {
         $affected = $affected->first();
         $ss=DB::select('select '.$_SESSION['APP_PATERN'].'.SF_CodeToStr("'.$affected->UserPassword.'") as pwd');
         $affected->UserPassword=$ss[0]->pwd;
      }
      return Response()->json($affected);
   }

   public function destroy(Request $request,$field='')
   {
      $result = parent::destroy($request);     
      DB::table($_SESSION['APP_PATERN'].'.users')->where('remember_token', $request->input('id').'-'.str_replace('-','',substr($request->input('DateAdd'),2,8)))->delete();
      return $result;
   }

}

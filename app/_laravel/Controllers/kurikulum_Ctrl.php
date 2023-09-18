<?php
namespace App\_laravel\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\db;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\__aaa\Controllers\mstr_Controller;
use App\_laravel\Models\kurikulum;

class kurikulum_Ctrl extends mstr_Controller
{

   function __construct()
   {
      parent::__construct();        
      $this->model=new kurikulum;
   }

    public function Matpel_del(Request $request)
    {
       $kurikulum_matpel = DB::table('kurikulum_matpel')
       ->where([['kurikulum_id','=',$request->kurikulum_id],['matpel_id','=',$request->matpel_id]])->delete();
       return Response()->json($kurikulum_matpel);
    }

    
    public function Matpel_add(Request $request)
    {
      $kurikulum_matpel = DB::table('kurikulum_matpel')->where([['kurikulum_id',$request->kurikulum_id],['matpel_id',$request->matpel_id]])->get();
      if ($kurikulum_matpel->isEmpty()) {
         $kurikulum_matpel=DB::table('kurikulum_matpel')->insert(['kurikulum_id'=>$request->kurikulum_id,'matpel_id'=>$request->matpel_id]);}
      return Response()->json($kurikulum_matpel);
    }    
 
}


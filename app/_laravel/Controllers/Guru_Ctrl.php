<?php
namespace App\_laravel\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\db;
use Illuminate\Database\Eloquent\Model;
use App\__aaa\Controllers\mstr_Controller;
use App\_laravel\Models\guru;

class Guru_Ctrl extends mstr_Controller
{

   function __construct()
   {
      parent::__construct();        
      $this->model=new guru;
   }

    public function edit(Request $request)
    {
      $guru = $this->model::where('id', $request->id)->first();
      $guru->matpels; 
      return Response()->json($guru);
    }
 
    public function Matpel_del(Request $request)
    {
       $guru_matpel = DB::table('guru_matpel')
       ->where([['guru_id','=',$request->guru_id],['matpel_id','=',$request->matpel_id]])->delete();
       return Response()->json($guru_matpel);
    }

    
    public function Matpel_add(Request $request)
    {
      $guru_matpel = DB::table('guru_matpel')->where([['guru_id',$request->guru_id],['matpel_id',$request->matpel_id]])->get();
      if ($guru_matpel->isEmpty()) {
         $guru_matpel=DB::table('guru_matpel')->insert(['guru_id'=>$request->guru_id,'matpel_id'=>$request->matpel_id]);}
      return Response()->json($guru_matpel);
    }    
 
}


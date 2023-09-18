<?php
namespace App\_laravel\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\db;
use Illuminate\Database\Eloquent\Model;
use App\__aaa\Controllers\mstr_Controller;
use App\_laravel\Models\m_customer;


class m_customer_Ctrl extends mstr_Controller
{

   function __construct()
   {
      parent::__construct();        
      $this->model=new m_customer;
      $this->head='Status Customer';
   }

   public function store(Request $request) {
      $m_customer = $this->model->Create(
      ['nama' => $request->nama, 'alamat' => $request->alamat, 'tanggal_lahir' => $request->tanggal_lahir, 
      'longitude' => $request->longitude, 'latitude' => $request->latitude, 'keterangan' => $request->keterangan, 'status' => $request->status]);
      return Response()->json($m_customer);
   }

   public function update(Request $request)
   {
      $m_customer = $this->model->where("id",$request->id)
      ->update(      ['nama' => $request->nama, 'alamat' => $request->alamat, 'tanggal_lahir' => $request->tanggal_lahir, 
      'longitude' => $request->longitude, 'latitude' => $request->latitude, 'keterangan' => $request->keterangan, 'status' => $request->status]);
      return Response()->json($m_customer);
    }

    public function edit(Request $request)
    {
      $m_customer = $this->model::where('id', $request->id)->first();
      return Response()->json($m_customer);
    }
 
    
}

function Brwm_customer() {
$m_customer_Ctrl = new m_customer_Ctrl;
return $m_customer_Ctrl->index();
}

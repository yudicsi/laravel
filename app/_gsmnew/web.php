<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\db;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

use App\_gsmnew\Controllers\OrdSales_Ctrl;


Route::get('test', function() {
  return view('PATERN::OrdSales_view',['tbl_Name'=>'OrdSales','tbl_sql'=>'OrdSales',
  'fluid'=>0 , 'head '=>'ORDER BELI']);
});

Route::get('ordsales', [OrdSales_Ctrl::class, 'index']);
Route::post('delete-ordsales', [OrdSales_Ctrl::class, 'destroy']);

Route::get('edit-ordsales', function (Request $request) {
  return OrdSales_Ctrl::edit_salespo1($request->id,$request->tgl);
});
Route::post('edit-ordsalesDlg', function (Request $request) {
  nama']='GSM'  ;
return OrdSales_Ctrl::edit_salespo2($request->id,$request->tgl);});
Route::post('update-ordsalesDlg', [OrdSales_Ctrl::class,'update']);


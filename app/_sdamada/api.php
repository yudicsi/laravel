<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\_sdamada\Controllers\Sales2_Ctrl;

Route::middleware('user_accessible')->group(function () {
  Route::get('sales2', function (Request $request) {
    return (new sales2_Ctrl)->GetRecords($request,'','UserId,UserName,KdSupl,email');
  });
  Route::get('Sales2-1', [sales2_Ctrl::class, 'index']);
  Route::get('Sales2', [sales2_Ctrl::class, 'index']);
  Route::post('sales2', [sales2_Ctrl::class, 'store']);
  Route::put('sales2', [sales2_Ctrl::class, 'update']);
  Route::delete('sales2', [sales2_Ctrl::class, 'destroy']);
});



<?php
namespace App\__stock\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\db;
use App\__aaa\Controllers\mstr_Controller;

class Langg_Ctrl extends mstr_Controller
{
   function __construct($tbl_sql='',$tbl_view='lang',$head='',$DirView='STOCK::')     
   {
      parent::__construct($tbl_sql,$tbl_view,$head,$DirView);     
      $ss='Kode,Nama,'.$_SESSION['APP_PATERN'].'.SF_Alamat(Alamat,Kota,KodePos,Telp,Hp) AS Almt,npwp,Keterangan,UserAdd, DateAdd, UserEdit, DateEdit';
      $this->model=DB::table($this->file_db)->selectRaw($ss);
      $this->primaryKey = 'Kode';

      $this->fillable = [
         'Kode',
         'Nama',
         'Alamat',
         'Kota',
         'KodePos',
         'Telp',
         'Fax',
         'npwp',
         'KdCabang',
         'Nama1',
         'Alamat1',
         'Kota1',
         'KodePos1',
         'Telp1',
         'Hp',
         'Bank',
         'No_Rek',
         'Keterangan',
         'UserAdd',
         'DateAdd',
         'UserEdit',
         'DateEdit',
         ];
   }   

}

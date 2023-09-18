<?php

namespace App\_gsmnew\Controllers;
use App\__aaa\Models\tr_ms;
use App\__aaa\Models\tr_dt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\db;
use App\__aaa\Controllers\mstr_Controller;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class OrdSales_Ctrl extends mstr_Controller
{

  public $po_dt, $po_ms;
  const tr='blms_';

  function __construct()
  {
    kode']='GSM';
    nama']='GSM';
    if (request()->ajax() && substr_count(request()->path(),'-')==0) {    
      $s1=Carbon::instance(APP_DATE']);
      $s1->submonth(12);
      $s2=Carbon::instance(APP_DATE']);
      $prd2=substr($s2->toDateString(),0,7);
      $prd1=substr($s1->toDateString(),0,7);
      $ms=ToTableName(self::tr,$prd2);
      $dt=str_replace('ms_','dt_',$ms);
      $ss='select a.Tanggal,a.No_Faktur as id, DATE_FORMAT(a.Tanggal, "%Y-%m-%d") as tgl,'.
      $_SESSION['APP_PATERN'].'.SF_Format(a.TotNota,0,NULL) as rp from '.$ms.' a where '.     //Kode="'.kode'].'"'.' and '
      'exists(select no_faktur from '.$dt.' b where a.No_Faktur=b.No_Faktur)';
      $tgl=' and Tanggal between "'.substr($s1->toDateString(),0,10).'" and "'.substr($s2->toDateString(),0,10).'"';
      $sql=$ss.$tgl;
      $prd=$prd1;
      while (strcmp($prd,$prd2)<0) {
         $s=str_replace($ms,ToTableName(self::tr,$prd),$ss);
         $s=str_replace($dt,ToTableName(self::tr,$prd),$s);
         $sql.=' union '.$s;
         if (strcmp($prd,$prd1)==0) {$sql.=$tgl;}
         $prd=incprd($prd);
      } 
      file_put_contents('c:\temp\hasil.txt',$sql);
      $this->model=db::select($sql);
      $this->fillable=0; 
    }
    parent::__construct(0,'ordsales');  
  }

   protected function GetSelect() {
      return $this->model;
    }

    protected function delete_exec(Request $request)
    {
      $tgl=$request->Tanggal;
      $ms=ToTableName(self::tr,$tgl);
      $dt=str_replace('ms_','dt_',$ms);
      if (DeleteRecord($dt,'No_Faktur',[$request->id])==0) return;
      return DeleteRecord($ms,'No_Faktur',[$request->id]);
    }

    public static function edit_salespo1()
    {
      return view('PATERN::ordsalesDlg_view',['tbl_sql'=>'ordsalesDlg','head' => 'PURCHASE ORDER XX',
      'fluid'=>0]); 
    }

    public static function edit_salespo2($id, $tgl)
        {
         $ms=ToTableName(self::tr,$tgl);
         $dt=str_replace('ms_','dt_',$ms);
         $db=strtolower(substr($dt,0,strripos($dt,'.')));
         $fgms=ToTableName('fgms');
         $fgdt=$db.'.fgdt';
         $s='select A.Qty,A.Qty2,A.Satuan,A.Satuan2,CONCAT(f.kdstruk," ",right(F.Lable,6)) as Kode, A.No_Satuan2,A.Total,';
         $s.='trim(F.Nama) as NamaFg, A.No_Satuan, A.No_Satuan2, A.Isi, A.Isi2, A.urut, f.Lable, F.KdStruk,A.QntKecil,';
         $s.='IF(IFNULL(A.Total,0)>0,A.Total/A.Qty,'.$db.'.SF_HRGX(a.lable,a.kdstruk,A.No_Satuan,NULL,NULL)) as Harga,';
         $s.='F.Isi_1,F.Sat_1,D.Hrg_Beli1,F.Isi_2,F.Sat_2,D.Hrg_Beli2,F.Isi_3,F.Sat_3,D.Hrg_Beli3,Urut,';
         $s.='A.DateAdd as id,'.$_SESSION['APP_PATERN'].'.SF_Group(F.KdGroup) as NmGroup ';
         $s.='from '.$dt.' a, '.$fgms.' f, '.$fgdt.' D where a.lable=f.lable and a.kdstruk=f.kdstruk and ';
         $s.='D.lable=f.lable and D.kdstruk=f.kdstruk and a.No_Faktur="'.$id.'" ORDER BY Urut';
         $res=DB::select($s);
         return datatables()
         ->of($res)->make(true);
    }


   public function update(Request $request)
   {
     $ms=ToTableName(self::tr,$request->tgl);
     $dt=str_replace('ms_','dt_',$ms);
     return UpdateRecord($request,$dt, 'Qty,Qty2,No_Satuan,No_Satuan2','No_Faktur,Urut');
    }


    protected function edit(Request $request)
    {
      return $this->edit_salespo2($request->id,$request->tgl);
    }

}

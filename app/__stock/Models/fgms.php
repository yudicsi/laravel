<?php
namespace App\__stock\Models;

use Illuminate\Support\Facades\DB;
use App\__aaa\Models\base_mdl;


class fgms extends base_mdl
{
  protected $fillable = ['Lable', 'KdStruk', 'KdPLU', 'Sisa', 'Barcode', 'Nama', 'KdGroup', 'Jenis', 'KdDisp', 'KdSupl', 'Sat_1', 'Isi_1', 'Sat_2', 'Isi_2', 'Sat_3', 'Isi_3', 'fgdt', 'UserAdd', 'DateAdd', 'UserEdit', 'DateEdit'];
  protected $appends = ['Hrg_Jual1'];
  protected $appends1 = ['Lable','KdStruk','Hrg_Jual1', 'Hrg_JlGr1', 'Hrg_Beli1', 'Hrg_Jual2', 'Hrg_JlGr2', 'Hrg_Beli2', 'Hrg_Jual3', 'Hrg_JlGr3', 'Hrg_Beli3'];
  protected $table = 'fgms';
  //protected $primaryKey = 'DateAdd';
  public $fgdt;
  public $t_fgdt;
  public $Select_Fgdt;
  
  public function __construct(array $attributes = [],$Trx = 'fgms',$Db = '') 
  {
    if(empty($Trx) && empty($this->table)) $this->table=$_SESSION['APP_PATERN'] . '.fgms';
    parent::__construct($attributes,$Trx,'',$Db);
    return $this;
  }

  public function fgdt()
  {
     return $this->hasOne(fgdt::class);
  }

  public function pos_dts() {
     return $this->hasMany(pos_dt::class, 'Key_Fgms', 'DateAdd');
  }

  function fgdt_hrg($keyLbl,$KeyStr, $field)
  {
    if (isset($this->fgdt) && Sizeof($this->fgdt)<1) return 0;
    if (!isset($this->fgdt) || strcasecmp($keyLbl.$KeyStr, $this->fgdt[0]->Lable.$this->fgdt[0]->KdStruk) != 0)
    {
      if (empty($this->t_fgdt)) {$this->t_fgdt = ToTableName('fgdt','',$_SESSION['APP_DB']);}
      if (empty($this->Select_Fgdt)) {$this->Select_Fgdt= 'select Lable, KdStruk,A.* from '.$this->t_fgdt.' A where KdCabang=:KdCabang and Lable=:Lable and KdStruk=:KdStruk';}
      $cab = $_SESSION['APP_KDCAB'];
      $hrg = '';
      $i=0;
      $L=sizeof($this->appends);
      while ($i<$L) 
      {$hrg.=$this->appends[$i];
       $i+=1;
       IF ($i<$L) $hrg.=',';
      };
      $this->fgdt = DB::select(str_replace('A.*',$hrg,$this->Select_Fgdt).' limit 1',['KdCabang'=>$cab,'Lable'=>$keyLbl,'KdStruk'=>$KeyStr]);
    }
    return (empty($this->fgdt)) ? 0 : $this->fgdt[0]->{$field};
  }

  public function getHrgJual1Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk,'Hrg_Jual1');
  }
  public function getHrgJlGr1Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk, 'Hrg_JlGr1');
  }
  public function getHrgBeli1Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk, 'Hrg_Beli1');
  }
  public function getHrgJual2Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk, 'Hrg_Jual2');
  }

  public function getHrgJlGr2Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk, 'Hrg_JlGr2');
  }
  public function getHrgBeli2Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk, 'Hrg_Beli2');
  }
  public function getHrgJual3Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk, 'Hrg_Jual3');
  }
  public function getHrgJlGr3Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk, 'Hrg_JlGr3');
  }
  public function getHrgBeli3Attribute()
  {
    $_lbl = $this->attributes['Lable'];
    $_struk = $this->attributes['KdStruk'];
    return $this->fgdt_hrg($_lbl,$_struk, 'Hrg_Beli3');
  }

}


<?php

namespace App\__stock\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\__aaa\Models\base_mdl;


class fgdt extends base_mdl
{
    protected $fillable = ['KdCabang', 'Lable', 'KdStruk', 'Hrg_Jual1', 'Hrg_JlGr1', 'Hrg_Beli1', 'Hrg_Jual2',
	'Hrg_JlGr2', 'Hrg_Beli2', 'Hrg_Jual3', 'Hrg_JlGr3', 'Hrg_Beli3', 'Hpp_Awal', 'Saldo_Min', 'Saldo_Awl', 'KdRak',
	'UserAdd', 'DateAdd', 'UserEdit', 'DateEdit', 'Key_Fgms', 'PriceDate', 'Ref'];
    protected $table = 'fgdt';
    
    // protected $primaryKey = 'Key_Fgms';

    public function __construct(array $attributes = [],$Trx = 'fgdt',$Db = '') 
    {
      if(empty($Trx) && empty($this->table)) $this->table=$_SESSION['APP_DB'] . '.fgdt';
      parent::__construct($attributes,$Trx,'',$Db);
      return $this;
    }
  
    public function fgms()
    {
        return $this->belongsTo(fgms::class);
    }
}    


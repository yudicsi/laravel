<?php
namespace App\__aaa\Models;

use Illuminate\Database\Eloquent\Model;

class base_mdl extends Model
{
  public $timestamps = false;
  public $incrementing = false;
  protected $keyType = 'string';
  public static $Trx1, $prd1, $Db1;
  use BindsDynamically;


  public function __construct(array $attributes = [], ?string $Trx = '', $prd = '', $Db = '') 
  {
    if(!empty($Trx)) $this->Trx1=$Trx;
    if(!empty($prd)) $this->prd1=$prd;
    if(!empty($Db)) $this->Db1=$Db;
    if(empty($this->table)) $this->table=toTableName($this->Trx1,$this->prd1,$this->Db1);
    parent::__construct($attributes);
    $ss=new class([], $this->table) extends Model {};
    if (! empty($fillable)) {$ss->fillable=$fillable;}
    return $ss;
}


}

trait BindsDynamically
{
    protected $connection = null;
    protected $table = null;

    public function bind(string $connection, string $table)
    {
        $this->setConnection($connection);
        $this->setTable($table);
    }
  }


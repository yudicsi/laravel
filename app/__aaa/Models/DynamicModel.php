<?php

namespace App\__aaa\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class DynamicModel extends Model
{
    public static $File;
    protected $fillable = ['id'];
    use BindsDynamically;
    private static array $modelClassToTableMap = [];
    public $timestamps = false;
    protected $primaryKey = 'id';
    
    /**
     * Protected constructor to make sure this is called from either
     * DynamicModel::table or internal static methods of Model. Otherwise, we cannot
     * track the class name related to the table
     */
    protected function __construct(array $attributes = [], ?string $table = null)
    {
        if (isset($table)) {
            // use table passed from DynamicModel::table
            $this->setTable($table);
        } elseif (isset(self::$modelClassToTableMap[\get_class($this)])) {
            // restore used table from map while internally creating new instances
            $this->setTable(self::$modelClassToTableMap[\get_class($this)]);
        } else {
            throw new \LogicException('Call DynamicModel::table to get a new instance and be able use any static model method.');
        }
        parent::__construct($attributes);
        $attr=getFields($this->getTable());
        if (!in_array($this->primaryKey, $attr)) {
            $this->primaryKey=getKeys($this->getTable());
            $this->incrementing = false;
        }
    }

    public static function table(string $table, $prd = '', $Db = '', $fillable = []): self
    {
        if (substr_count($table,'.')==0 && (gettype($prd) == "string") && empty($prd.$Db)) {
          $File=$table;}
        else {
          $table=toTableName($table,$prd,$Db);
        }
        $ss=new class([], $table) extends DynamicModel {};
        return $ss;
    }

    public function setFillable($fillable = []) 
    {
    if (! empty($fillable)) 
        return $fillable;
     else 
        return getFields($this->getTable());
    }


    public function setTable($table): self
    {
        self::$modelClassToTableMap[\get_class($this)] = $table;

        return parent::setTable($table);
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

    public function newInstance($attributes = [], $exists = false)
    {
        // Overridden in order to allow for late table binding.

        $model = parent::newInstance($attributes, $exists);
        $model->setTable($this->table);

        return $model;
    }

}
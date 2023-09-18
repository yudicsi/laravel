<?php

namespace App\__stock\Models;

use App\__aaa\Models\tr_dt;

class pos_dt extends tr_dt
{
    public function __construct(array $attributes = [], ?string $Trx = '', $prd = '', $Db = '') 
    {
      parent::__construct($attributes,$Trx,$prd,$Db);

      return $this;
  }
  
}    



<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'ds';
   public $timestamps = false;

    public function models(){
        return $this->has_many('Teacher');
    }

}

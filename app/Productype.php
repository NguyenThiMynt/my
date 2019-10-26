<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productype extends Model
{
    protected $table = 'productypes';

    public function product()
    {
        return $this->hasMany('App\Product', 'id_productype', 'id');
    }
}

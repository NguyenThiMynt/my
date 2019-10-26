<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function productype()
    {
        return $this->hasMany('App\Productype', 'id_category', 'id');
    }

    public function product()
    {
        return $this->hasManyThrough('App\Product', 'App\Productype', 'id_category', 'id_productype', 'id');
    }
}

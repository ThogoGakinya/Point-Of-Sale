<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function inventory()
    {
        return $this->hasMany('App\Staff\Inventory');
    }
    public function uom()
    {
        return $this->belongsTo('App\Admin\UnitOfMeasure');
    }
    public function categorysize()
    {
        return $this->hasMany('App\Admin\CategorySize');
    }
}

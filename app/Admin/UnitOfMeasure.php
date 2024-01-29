<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class UnitOfMeasure extends Model
{
    public function inventory()
    {
        return $this->hasMany('App\Staff\Inventory');
    }
    public function topping()
    {
        return $this->hasMany('App\Staff\Toppings');
    }
    public function size()
    {
        return $this->hasMany('App\Staff\Size');
    }
    public function category()
    {
        return $this->belongsTo('App\Admin\Category');
    }
}

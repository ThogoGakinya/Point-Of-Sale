<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Admin\Category');
    }
    public function flavour()
    {
        return $this->hasMany('App\Admin\Flavour');
    }
    public function size()
    {
        return $this->belongsTo('App\Admin\Size');
    }
    public function uom()
    {
        return $this->belongsTo('App\Admin\UnitOfMeasure');
    }
    public function sales()
    {
        return $this->hasMany('App\Admin\Sale');
    }
    public function reports()
    {
        return $this->hasMany('App\Admin\Report');
    }
}

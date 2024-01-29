<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function inventory()
    {
        return $this->hasMany('App\Staff\Inventory');
    }
    public function uom()
    {
        return $this->hasMany('App\Staff\UnitOfMeasure');
    }
    public function flavour()
    {
        return $this->hasMany('App\Staff\UnitOfMeasure');
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

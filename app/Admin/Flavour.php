<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Flavour extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Admin\Category');
    }
    public function categoryflavour()
    {
        return $this->hasMany('App\Admin\CategoryFlavour');
    }
    public function reports()
    {
        return $this->hasMany('App\Admin\Report');
    }
    public function inventory()
    {
        return $this->hasMany('App\Admin\Inventory');
    }
}

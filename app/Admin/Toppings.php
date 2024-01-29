<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Toppings extends Model
{
    public function uom()
    {
        return $this->belongsTo('App\Admin\UnitOfMeasure');
    }
}

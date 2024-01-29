<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Admin\Category');
    }
    public function flavour()
    {
        return $this->belongsTo('App\Admin\Flavour');
    }
    public function product()
    {
        return $this->belongsTo('App\Admin\Inventory');
    }
}

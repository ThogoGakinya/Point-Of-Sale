<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Voids extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Admin\Inventory');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function recall()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Admin\Category');
    }
}

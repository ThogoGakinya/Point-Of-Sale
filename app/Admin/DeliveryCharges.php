<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class DeliveryCharges extends Model
{
    public function route()
    {
        return $this->belongsTo('App\Admin\DeliveryRoute');
    }
}

<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class DeliveryRoute extends Model
{
    public function deliverycharges()
    {
        return $this->hasMany('App\Admin\DeliveryCharges');
    }
}

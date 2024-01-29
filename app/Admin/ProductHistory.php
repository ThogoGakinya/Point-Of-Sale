<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

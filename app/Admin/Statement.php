<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

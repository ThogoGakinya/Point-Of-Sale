<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CategorySize extends Model
{
    public function size()
    {
        return $this->belongsTo('App\Admin\Size');
    }
}

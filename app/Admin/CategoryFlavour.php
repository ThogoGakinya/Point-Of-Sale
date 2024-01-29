<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CategoryFlavour extends Model
{
    public function flavour()
    {
        return $this->belongsTo('App\Admin\Flavour');
    }
}

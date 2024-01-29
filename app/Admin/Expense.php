<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

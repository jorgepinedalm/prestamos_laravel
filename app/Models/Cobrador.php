<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cobrador extends Model 
{

    protected $table = 'cobrador';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasUser()
    {
        return $this->hasOne('App\Models\User', 'id');
    }

}
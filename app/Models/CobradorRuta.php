<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CobradorRuta extends Model 
{

    protected $table = 'cobrador_ruta';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
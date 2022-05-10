<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodoPrestamo extends Model 
{

    protected $table = 'periodo_prestamo';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasLoans()
    {
        return $this->hasMany('App\Models\Prestamo', 'periodo_prestamo_id');
    }

}
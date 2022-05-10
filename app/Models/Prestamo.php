<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestamo extends Model 
{

    protected $table = 'prestamo';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasCustomer()
    {
        return $this->hasOne('App\Models\Cliente', 'id');
    }

    public function hasStates()
    {
        return $this->hasMany('App\Models\PrestamoEstadoPrestamo', 'prestamo_id');
    }

    public function hasPeriod()
    {
        return $this->hasOne('App\Models\PeriodoPrestamo', 'id');
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoPrestamo extends Model 
{

    protected $table = 'estado_prestamo';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasLoans()
    {
        return $this->hasMany('App\Models\PrestamoEstadoPrestamo', 'estado_prestamo_id');
    }

}
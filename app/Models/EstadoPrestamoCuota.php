<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoPrestamoCuota extends Model 
{

    protected $table = 'estado_prestamo_cuota';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasCuotas()
    {
        return $this->hasMany('App\Models\PrestamoCuota', 'estado_prestamo_cuota_id');
    }

}
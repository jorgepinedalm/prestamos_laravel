<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedioPago extends Model 
{

    protected $table = 'medio_pago';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cuotas()
    {
        return $this->hasMany('App\Models\PrestamoCuota', 'medio_pago_id', 'id');
    }

}
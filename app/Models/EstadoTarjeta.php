<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoTarjeta extends Model 
{

    protected $table = 'estado_tarjeta';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasCards()
    {
        return $this->hasMany('App\Models\Tarjeta', 'estado_tarjeta_id');
    }

}
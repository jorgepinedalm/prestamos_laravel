<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarjeta extends Model 
{

    protected $table = 'tarjeta';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasLoan()
    {
        return $this->hasOne('App\Models\Prestamo', 'id');
    }

    public function hasCobrador()
    {
        return $this->hasOne('App\Models\Cobrador', 'user_id');
    }

    public function hasState()
    {
        return $this->hasOne('App\Models\EstadoTarjeta', 'id');
    }

}
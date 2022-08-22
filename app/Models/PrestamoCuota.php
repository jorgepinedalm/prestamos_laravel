<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrestamoCuota extends Model 
{

    protected $table = 'prestamo_cuota';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
        //return $this->hasOne('App\Models\Cliente', 'id');
    }

    public function prestamo()
    {
        return $this->hasOne('App\Models\Prestamo', 'id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoPrestamoCuota::class);
        //return $this->hasOne('App\Models\Cliente', 'id');
    }

    public function periodo()
    {
        return $this->belongsTo(PeriodoPrestamo::class);
        //return $this->hasOne('App\Models\PeriodoPrestamo', 'id');
    }

    public function hasUser()
    {
        return $this->hasOne('App\Models\User', 'id');
    }

}
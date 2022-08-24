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

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
        //return $this->hasOne('App\Models\Cliente', 'id');
    }

    public function hasStates()
    {
        return $this->hasMany('App\Models\PrestamoEstadoPrestamo', 'prestamo_id');
    }

    public function periodo()
    {
        return $this->belongsTo(PeriodoPrestamo::class, 'periodo_prestamo_id');
        //return $this->hasOne('App\Models\PeriodoPrestamo', 'id');
    }

    public function cobrador()
    {
        return $this->belongsTo(Cobrador::class, 'cobrador_id', 'user_id');
        //return $this->hasOne('App\Models\PeriodoPrestamo', 'id');
    }

    public function prestamoCuotas()
    {
        return $this->hasMany('App\Models\PrestamoCuota', 'prestamo_id');
    }


}
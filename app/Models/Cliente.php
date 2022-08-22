<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model 
{

    protected $table = 'cliente';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasPhotos()
    {
        return $this->hasMany('App\Models\ClienteImagenes', 'cliente_id');
    }

    public function prestamos()
    {
        return $this->hasMany('App\Models\Prestamo', 'cliente_id');
    }

}
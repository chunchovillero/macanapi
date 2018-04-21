<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use App\Comuna;
Use App\Region;

class Sucursal extends Model
{
   protected $table = 'datos_sucursales';
   protected $primaryKey = 'iddatos_sucursales';

   public function comuna() {
		return $this->belongsTo('App\Comuna', 'comuna_idcomuna', 'idcomuna' );
	}

	public function region() {
		return $this->belongsTo('App\Region', 'region_idregion', 'idregion' );
	}
}

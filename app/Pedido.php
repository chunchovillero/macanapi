<?php

namespace App;
use App\Sucursal;
Use App\Estado;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
	protected $table = 'pedido';
	protected $primaryKey = 'idpedido';

	public function sucursal() {
		return $this->belongsTo('App\Sucursal', 'sucursal_idsucursal', 'iddatos_sucursales' );
	}

	public function estado() {
		return $this->belongsTo('App\Estado', 'estado_idestado', 'idestado' );
	}

	public $timestamps = false;
}

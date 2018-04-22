<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Response;
use App\Pedido;
use App\Sucursal;



class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function pedidos($idusuario)
    {


        $pedidos=Pedido::where('usuario_idusuario',$idusuario)->with('sucursal')->with('estado')->get();

        
        return Response::json($pedidos);
    }


    public function ingresarpedido(request $request)
    {
    $hoy = date("Y-m-d");
    $fecha_crea = date("Y-m-d H:i:s");
    $ip = $_SERVER["REMOTE_ADDR"];

    $sucursales = Sucursal::where('iddatos_sucursales', $request->sucursal)->with('comuna')->with('region')->first();

    $pedido                                          = new Pedido;
    $pedido->usuario_idusuario                       = $request->idusuario;
    $pedido->estado_idestado                         = 1;
    $pedido->estadopago_idestadopago                 = 0;
    $pedido->direccion_despacho_iddireccion_despacho = $request->sucursal;
    $pedido->comuna_idcomuna                         = $sucursales->comuna->idcomuna;
    // $pedido->vendedor_idvendedor                     = "";
    $pedido->sucursal_idsucursal                     = $request->sucursal;
    // $pedido->tipo_mercado_idtipo_mercado             = "";
    // $pedido->forma_pago_idforma_pago                 = "";
    $pedido->activo                                  = "S";
    $pedido->public                                  = "N";
    $pedido->posicion                                = "1";
    $pedido->monto_total                             = "0";
    $pedido->valor_despacho                          = "0";
    $pedido->empresa                                 = "";
    $pedido->numero_factura                          = "";
    $pedido->numero_comprobante                      = "";
    $pedido->bultos                                  = "";
    // $pedido->descuento_local                         = "";
    // $pedido->descuento                               = "";
    $pedido->fecha_pedido                            = $hoy;
    $pedido->fecha_confirmacion_cliente              = "";
    $pedido->fecha_anulacion_cliente                 = "";
    $pedido->fecha_pago                              = "0";
    $pedido->numero_pedido                           = "0";
    $pedido->observacion                             = $request->observacion;
    $pedido->obra                                    = "";
    //$pedido->ticket                                  = "";
    $pedido->token                                   = "";
    $pedido->metodo_despacho                         = $request->despacho;
    $pedido->fecha_crea                              = $request->despacho;
    $pedido->ip_crea                                 = $ip;
    // $pedido->user_crea                               = "";
    // $pedido->fecha_mod                               = "";
    // $pedido->ip_mod                                  = "";
    // $pedido->user_mod                                = "";
    $pedido->save();

    return Response::json(['success' => true, 'successMessage' => 'Actualizado', 'pedido'=>$pedido]);

}

}

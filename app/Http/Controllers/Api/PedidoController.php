<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Response;
use App\Pedido;



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

         return Response::json(['success' => true, 'successMessage' => 'Actualizado', 'despacho'=>$request->despacho]);

    }

}

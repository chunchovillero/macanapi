<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Response;
use App\User;

class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('correo', 'password');

        if (!$token = $this->jwtAuth->attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $user = $this->jwtAuth->authenticate($token);

        return response()->json(compact('token', 'user'));
    }

    public function refresh()
    {
        $token = $this->jwtAuth->getToken();
        $token = $this->jwtAuth->refresh($token);

        return response()->json(compact('token'));
    }

    public function logout()
    {
        $token = $this->jwtAuth->getToken();
        $this->jwtAuth->invalidate($token);

        return response()->json(['logout']);
    }

    public function me()
    {
        if (!$user = $this->jwtAuth->parseToken()->authenticate()) {
            return response()->json(['error' => 'user_not_found'], 404);
        }

        return response()->json(compact('user'));
    }

    public function getUser($id){
        $user=User::where('idusuario',$id)->first();
        return Response::json($user);
    }

    public function editme(request $request, $id)
    {

        $user = User::find($id);
        $user->nombres = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->celular = $request->celular;

        $user->save();

        return Response::json(['success' => true, 'successMessage' => 'Actualizado','user'=>$request->nombres, 'id'=>$id]);

    }

    public function cambiarContrasena(Request $request)
    {

        if($request->nueva==$request->renueva){
            $usuarioLogueado = $request->idusuario;
            $user = Usuario::find($usuarioLogueado);
            $user->password=Hash::make($request->nueva);
            $user->save();
            return Response::json(['success' => true, 'successMessage' => 'Actualizado']);
        }else{
            return Response::json(['success' => false, 'successMessage' => 'No Actualizado']);
        }




    }



}

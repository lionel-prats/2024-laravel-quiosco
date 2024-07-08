<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;

class AuthController extends Controller
{
    public function register(RegistroRequest $request)
    {
        // validar el registro (v308)
        // $request->validated() internamente se va a servir de las validaciones definidas en RegistroRequest->rules() para validar la info recibida en el request (v308)
        // si hay errores de validacion en el form de registro submiteado desde el cliente, esta linea automaticamente envia una respuesta JSON con los mensajes de error que correspondan 
        $data = $request->validated();

        // return json_encode($data["name"]);

        // la peticion paso la validacion, creo al usuario en DB (v313)
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => $data["password"]
            // "password" => Hash::make($request->get("password")), (al menos desde la version 10.10 de laravel el hash es automatico)
            // "password" => bcrypt($data["password"]), (al menos desde la version 10.10 de laravel el hash es automatico)
        ]); 

        // retorno una respuesta JSON al cliente (v313)
        return [
            "token" => $user->createToken("token")->plainTextToken,
            "user" => $user
        ];
    }
    public function login(LoginRequest $request)
    {
        $data = $request->validated(); // v316
        // return json_encode($data); // {"email":"lionel@correo.com","password":"asdasdasd"} 

        // revisar password (v317)
        // Auth es la clase para autenticar (v317)
        // el metodo attempt() de la clase Auth va a intentar autenticar al usuario verificando si el email y password que le pasamos matchea con algun registro de la DB
        if(!Auth::attempt($data)){
            return response([
                "errors" => [
                    "autenticacion" => ["Credenciales inválidas"]
                ]
            ], 422);
        }

        
        // autenticar al usuario (v318)
        // en este punto el usuario esta autenticado
        $user = Auth::user(); // obtenemos la info del usuario autenticado
        
        // esta linea hace un INSERT en personal_access_tokens
        // el return de esta linea es un token que pasamos al cliente y que va a estar asociado al INSERT de personal_access_tokens
        $token = $user->createToken("token")->plainTextToken;
        return [
            "token" => $token,
            "user" => $user
        ];


    }
    public function logout(Request $request)
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return redirect('/');
    }
}

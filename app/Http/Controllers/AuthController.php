<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegistroRequest $request)
    {
        // validar el registro (v308)
        // $request->validated() internamente se va a servir de las validaciones definidas en RegistroRequest->rules() para validar la info recibida en el request (v308) 
        $data = $request->validated();
    
    }
    public function login(Request $request)
    {
    }
    public function logout(Request $request)
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return redirect('/');
    }
}

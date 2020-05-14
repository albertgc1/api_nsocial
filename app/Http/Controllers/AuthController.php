<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'avatar' => 'image',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password'
        ]);

    	$user = User::create([
    		'name' => $request->name,
            'last_name' => $request->last_name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password)
    	]);

    	return $this->userData($user);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

    	$user = User::where('email', $request->email)->first();

    	if($user){
    		if(Hash::check($request->password, $user->password)){
    			return $this->userData($user);
    		}else{
    			return response()->json(['message' => 'Credenciales incorrectas'], 401);
    		}
    	}else{
    		return response()->json(['message' => 'Credenciales incorrectas'], 401);
    	}
    }

    public function userData($user)
    {
    	$token = $user->createToken($user->name);

    	return response()->json([
    		'user' => $user,
    		'token' => $token->plainTextToken
    	]);
    }

    public function logout(Request $request)
    {
    	return $request->user()->tokens()->delete();
    }
}

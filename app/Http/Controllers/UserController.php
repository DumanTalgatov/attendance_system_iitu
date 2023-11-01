<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => "Kadyr",
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response([
            "data" => $user,
            "token" => $token
        ]);
    }

    public function login(Request $request){
        Log::info(request()->all());
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || Hash::check($user->password, $fields['password'])){
            return "error";
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response([
            "user" => $user,
            "access_token" => $token
        ]);
    }
}

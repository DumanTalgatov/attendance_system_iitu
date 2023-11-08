<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\CodeForFriend;
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
            'name' => "Duman",
            'student_id' => 38546,
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
//        Log::info(request()->all());
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user){
            return response([
                "error.email" => "Incorrect email",
            ], 401);
        }

        if(!Hash::check($fields['password'], $user->password)){
            return response([
                "error.password" => "Incorrect password",
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response([
            "user" => $user,
            "status" => 200,
            "access_token" => $token
        ], 200);
    }

    public function loginByCard(Request $request)
    {
        $fields = $request->validate([
            "student_id" => "required"
        ]);

        $user = User::where("student_id", $fields["student_id"])->first();

        if(!$user){
            return response([
                "error.student_id" => "Incorrect id"
            ], 401);
        }

        $attendance = Attendance::create([
            "student_id" => $fields["student_id"],
            "type" => "card"
        ]);

        return  response([
            "user" => $user,
            "status" => 200
        ], 200);
    }

    public function loginByMachine(Request $request){
        $fields = $request->validate([
            "student_id" => "required",
            "password" => "required"
        ]);

        $user = User::where('student_id', $fields["student_id"])->first();

        if(!$user){
            return response([
                "error.student_id" => "Incorrect id"
            ], 401);
        }

        if(!Hash::check($fields['password'], $user->password)){
            return response([
                "error.password" => "Incorrect password"
            ], 401);
        }

        $attendance = Attendance::create([
            "student_id" => $fields["student_id"],
            "type" => "machine"
        ]);

        return response([
            "user" => $user,
            "status" => 200,
        ], 200);
    }

    public function loginByFriend(Request $request){
        $fields = $request->validate([
            'student_id' => 'required',
            'code' => 'required'
        ]);

        $user = CodeForFriend::where('student_id', $fields['student_id'])->first();

        if(!$user){
            return response([
                "error.student_id" => "Incorrect id"
            ], 401);
        }

        if($user->code !== $fields['code']){
            return response([
                "error.code" => "Incorrect code"
            ], 401);
        }

        $attendance = Attendance::create([
            "student_id" => $fields["student_id"],
            "type" => "by friend"
        ]);

        return response([
            "user" => $user,
            "status" => 200,
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\CodeForFriend;
use App\Models\MachineSchedule;
use App\Models\User;
use Carbon\Carbon;
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
            'name' => "Talgat",
            'student_id' => 38547,
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role' => 3
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response([
            "data" => $user,
            "token" => $token
        ]);
    }

    public function test(Request $request){
        $dateTimeString = $request->input('datetime');

        // Create a Carbon instance from the datetime string
        $carbonDateTime = Carbon::parse($dateTimeString);

        // Get date separately
        $date = $carbonDateTime->toDateString(); // Format: Y-m-d

        // Get time separately
        $time = $carbonDateTime->toTimeString(); // Format: H:i:s

        // Convert date to weekday
        $weekday = $carbonDateTime->format('l'); // Full textual representation of the day (e.g., Monday)

        // Now you can use $date, $time, and $weekday as needed

        return response()->json([
            'date' => $date,
            'time' => $time,
            'weekday' => $weekday,
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

        $dateTimeString = $request->input('datetime');

        // Create a Carbon instance from the datetime string
        $carbonDateTime = Carbon::parse($dateTimeString);

        // Get date separately
        $date = $carbonDateTime->toDateString(); // Format: Y-m-d

        // Get time separately
        $time = $carbonDateTime->toTimeString(); // Format: H:i:s

        // Convert date to weekday
        $weekday = $carbonDateTime->format('l'); // Full textual representation of the day (e.g., Monday)

        $machineSchedule = MachineSchedule::select("course_id", "group_id", "lesson_type")
            ->where("weekday", $weekday)
            ->where("start_time", "<", $time)
            ->where("end_time", ">", $time)
            ->first();

        $attendance = Attendance::create([
            "student_id" => $fields["student_id"],
            "group_id" => $machineSchedule->group_id,
            "date" => $date,
            "course_id" => $machineSchedule->course_id,
            "lesson_type" => $machineSchedule->lesson_type,
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
            "group_id" => $user->group_id,
            "date" => now(),
            "course_id" => $request->input("course_id"),
            "lesson_type" => $request->input("lesson_type"),
            "type" => "code"
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
        $student = User::where('student_id', $fields["student_id"])->first();

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
            "group_id" => $student->group_id,
            "date" => now(),
            "course_id" => $request->input("course_id"),
            "lesson_type" => $request->input("lesson_type"),
            "type" => "by friend"
        ]);

        return response([
            "user" => $user,
            "status" => 200,
        ], 200);
    }
}

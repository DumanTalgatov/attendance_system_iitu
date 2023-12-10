<?php

namespace App\Http\Controllers;

use App\Models\StudentFriend;
use App\Models\User;
use Illuminate\Http\Request;

class StudentFriendController extends Controller
{
    public function addFriends(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|numeric',
            'student_id' => 'required|numeric',
        ]);

        $friendId = $request->input('friend_id');
        $studentId = $request->input('student_id');

        $studentsGroup = User::where("student_id", $studentId)->pluck("group_id");
        $friendsGroup = User::where("student_id", $friendId)->pluck("group_id");

        $counts = StudentFriend::where("student_id", $studentId)->count();

        if ($counts >= 2) {
            return response()->json([
                "error" => "count of friend can't be more than 2"
            ], 422);
        }

        if($studentsGroup->first() === $friendsGroup->first()){
            StudentFriend::firstOrCreate([
                "student_id" => $studentId,
                "friend_id" => $friendId,
            ]);

            return response("success", 200);
        }
        else{
            return response()->json([
                "error" => "student from different groups"
            ], 422);
        }
    }

    public function deleteFriends(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|numeric', // Adjust validation rules as needed
            'student_id' => 'required|numeric',
        ]);

        $friendId = $request->input('friend_id');
        $studentId = $request->input('student_id');

        $userFriend = StudentFriend::where("friend_id", $friendId)
            ->where("student_id", $studentId)->first();

        if(!$userFriend) {
            return response()->json([
                "error" => "you don't have user with this id"
            ], 422);
        }

        $userFriend->delete();

        return response()->json([
            "message" => "successfully deleted"
        ], 200);
    }

    public function showFriends(Request $request)
    {
        $studentId = $request->input('student_id');

        $studentsGroup = User::where("student_id", $studentId)->pluck("group_id");
        $userFriend = StudentFriend::where("student_id", $studentId)->pluck("friend_id");

        $users = User::where("role", 3)
            ->where("student_id", "!=", $studentId)
            ->where("group_id", $studentsGroup)
            ->whereIn("student_id", $userFriend)
            ->get();

        if(!$users) {
            return response()->json([
                "error" => "you don't have friends"
            ], 200);
        }

        return $users;
    }

    public function searchFriends(Request $request)
    {
        $studentId = $request->input('student_id');
        $search = $request->input('search');
        $studentsGroup = User::where("student_id", $studentId)->pluck("group_id");
        return User::where("role", 3)
            ->where("student_id", "!=", $studentId)
            ->where("group_id", $studentsGroup)
            ->where('name', 'like', "%$search%")
            ->get();
    }

    public function sendCode(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|numeric',
            'student_id' => 'required|numeric',
        ]);

        $friendId = $request->input('friend_id');
        $studentId = $request->input('student_id');

        $userFriend = StudentFriend::where("friend_id", $friendId)
            ->where("student_id", $studentId)->first();

        if(!$userFriend) {
            return response()->json([
                "error" => "you don't have user with this id"
            ], 422);
        }

        $userFriend->update([
            'code' => $request->code,
            'permission' => 1
        ]);

        return response()->json([
            "message" => "successfully send code"
        ], 200);
    }
}

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
            return "fail";
        }

        if($studentsGroup->first() === $friendsGroup->first()){
            StudentFriend::firstOrCreate([
                "student_id" => $studentId,
                "friend_id" => $friendId,
            ]);
        }

        return "success";
    }

    public function deleteFriends(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|numeric', // Adjust validation rules as needed
            'student_id' => 'required|numeric',
        ]);

        $friendId = $request->input('friend_id');
        $studentId = $request->input('student_id');

        StudentFriend::where("friend_id", $friendId)
            ->where("student_id", $studentId)->delete();

        return "deleted";
    }

    public function showFriends(Request $request)
    {
        $studentId = $request->input('student_id');

        $studentsGroup = User::where("student_id", $studentId)->pluck("group_id");

        $users = User::where("role", 3)
            ->where("student_id", "!=", $studentId)
            ->where("group_id", $studentsGroup)
            ->get();

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
}

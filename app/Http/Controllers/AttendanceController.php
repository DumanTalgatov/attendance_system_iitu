<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class AttendanceController extends Controller
{
    public function getAttendanceForStudent(Request $request, $courseId = null, $year = null, $month = null){
        $attendance = Attendance::with('course')->where("student_id", 38546);

        if ($request->courseId!=null && !is_numeric($request->courseId)){
            return response()->json(["error"=>"invalid parameter"], 422);
        }

        if ($request->year!=null && !is_numeric($request->year)){
            return response(["error"=>"invalid parameter"], 422);
        }

        if ($request->month!=null && $request->month>12){
            return response()->json(["error"=>"invalid month parameter"], 422);
        }

        if($courseId){
            $attendance->where("course_id", $courseId);
        }

        if($year){
            $attendance->whereYear("date", $year);
        }

        if($month){
            $attendance->whereMonth("date", $month);
        }

        $result = $attendance->get();

        return response($result, 200);
    }

    public function getAttendanceForTeacher(Request $request, $courseId = null, $year = null, $month = null, $groupId = null){
        $attendance = Attendance::with('users', 'course')->where("course_id", $courseId);

        if ($request->groupId!=null && !is_numeric($request->groupId)){
            return response()->json(["error"=>"invalid parameter"], 422);
        }

        if($courseId){
            $attendance->where("course_id", $courseId);
        }

        if($year){
            $attendance->whereYear("date", $year);
        }

        if($month){
            $attendance->whereMonth("date", $month);
        }

        if($groupId){
            $groupStudents = User::where("group_id", $groupId)->get(["student_id"]);
            $attendance->whereIn("student_id", $groupStudents);
        }

        $result = $attendance->get();

        return response($result, 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class AttendanceController extends Controller
{
    public function getAttendanceForStudent(Request $request, $courseId = null, $year = null, $month = null){
//        dd($request->courseId);
        $attendance = Attendance::query()->where("student_id", 38546);

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

    public function getAttendanceForTeacher($courseId = null, $year = null, $month = null){
        $attendance = Attendance::query();

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
}

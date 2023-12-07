<?php

namespace App\Http\Controllers;

use App\Models\Excuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExcuseController extends Controller
{
    public function addExcuse(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "excuse_text" => "required|string|max:200"
        ]);

        $file = $request->file('excuse_file');
        $filePath = $file->store('public/excuse_files');

        if($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ], 422);
        }

        $excuse = Excuse::create([
            "excuse_text" => $request->input("excuse_text"),
            "excuse_type" => $request->input("excuse_type"),
            "excuse_file" => $filePath,
            "excuse_date" => $request->input("excuse_date"),
            "student_id" => $request->input("student_id"),
        ]);

        return response()->json([
            "success" => "successfully added"
        ]);
    }
}

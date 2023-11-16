<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/loginByMachine', [UserController::class, 'loginByMachine']);
Route::post('/loginByFriend', [UserController::class, 'loginByFriend']);
Route::post('/loginByCard', [UserController::class, 'loginByCard']);
Route::get('/getAttendanceForStudent/{courseId?}/{year?}/{month?}', [AttendanceController::class, 'getAttendanceForStudent']);
Route::get('/getAttendanceForTeacher/{courseId?}/{year?}/{month?}/{groupId?}', [AttendanceController::class, 'getAttendanceForTeacher']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

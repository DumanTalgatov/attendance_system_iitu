<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentFriendController;
use App\Http\Controllers\ExcuseController;

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
Route::post('/test', [UserController::class, 'test']);
Route::get('/getAttendanceForStudent/{courseId?}/{year?}/{month?}', [AttendanceController::class, 'getAttendanceForStudent']);
Route::get('/getAttendanceForTeacher/{courseId?}/{year?}/{month?}/{groupId?}', [AttendanceController::class, 'getAttendanceForTeacher']);
Route::controller(StudentFriendController::class)->group(function () {
    Route::post("addFriends", "addFriends")->name("friends.addFriends");
    Route::post("deleteFriends", "deleteFriends")->name("friends.deleteFriends");
    Route::get("showFriends", "showFriends")->name("friends.showFriends");
    Route::get("searchFriends", "searchFriends")->name("friends.searchFriends");
    Route::post("sendCode", "sendCode")->name("friends.sendCode");
});
Route::post('/addExcuse', [ExcuseController::class, 'addExcuse']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

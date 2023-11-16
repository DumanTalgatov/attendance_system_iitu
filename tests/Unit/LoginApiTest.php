<?php

namespace Tests\Unit;

use App\Models\CodeForFriend;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
//    use RefreshDatabase;
//    public function test_example(): void
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

//    public function test_valid_login()
//    {
//        $user = User::create([
//            'name' => 'Duman',
//            'student_id' => 38546,
//            'email' => 'duman@gmail.com',
//            'password' => Hash::make('123456')
//        ]);
//
//        $response = $this->json('POST', 'api/login', [
//            'email' => 'duman@gmail.com',
//            'password' => '123456'
//        ]);
//
//        $response->assertStatus(200);
//        $this->actingAs($user);
//        $this->assertAuthenticated();
//    }
//
//    public function test_invalid_login()
//    {
//        $response = $this->json('POST', 'api/login', [
//            'email' => 'wrong@gmail.com',
//            'password' => 'wrongpassword',
//        ]);
//
//        $response->assertStatus(401);
//        $this->assertGuest();
//    }
//
//    public function test_valid_login_by_machine()
//    {
//        $user = User::create([
//            'name' => "Duman",
//            'student_id' => 38546,
//            'email' => "duman@gmail.com",
//            'password' => Hash::make('123456')
//        ]);
//
//        $response = $this->json('POST', 'api/loginByMachine', [
//            'student_id' => 38546,
//            'password' => '123456'
//        ]);
//
//        $response->assertStatus(200);
//        $this->actingAs($user);
//        $this->assertAuthenticated();
//    }
//
//    public function test_valid_login_by_friend()
//    {
//        $user = User::create([
//            'name' => "Duman",
//            'student_id' => 38546,
//            'email' => "duman@gmail.com",
//            'password' => Hash::make('123456')
//        ]);
//        $user2 = User::create([
//            'name' => "Talgatov",
//            'student_id' => 38547,
//            'email' => "talgatov@gmail.com",
//            'password' => Hash::make('123456')
//        ]);
//
//        $codeForFriend = CodeForFriend::create([
//            'student_id' => 38546,
//            'friend_id' => 38547,
//            'code' => "asdfg"
//        ]);
//
//        $response = $this->json('POST', 'api/loginByFriend', [
//            'student_id' => 38546,
//            'code' => 'asdfg'
//        ]);
//
//        $response->assertStatus(200);
////        $this->actingAs($user);
////        $this->assertAuthenticated();
//    }
//
//    public function test_valid_login_by_card()
//    {
//        $user = User::create([
//            'name' => "Duman",
//            'student_id' => 38546,
//            'email' => "duman@gmail.com",
//            'password' => Hash::make('123456')
//        ]);
//
//        $response = $this->json('POST', 'api/loginByCard', [
//            'student_id' => 38546,
//        ]);
//
//        $response->assertStatus(200);
//    }
//
//    public function test_invalid_login_by_card()
//    {
//        $user = User::create([
//            'name' => "Duman",
//            'student_id' => 38546,
//            'email' => "duman@gmail.com",
//            'password' => Hash::make('123456')
//        ]);
//
//        $response = $this->json('POST', 'api/loginByCard', [
//            'student_id' => 456456,
//        ]);
//
//        $response->assertStatus(401);
//    }
}

<?php

namespace Tests\Unit;

use App\Models\StudentFriend;
use Tests\TestCase;

class FriendsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddFriendCorrectly()
    {
        $response = $this->json('POST', 'api/addFriends', [
            "student_id" => 38546,
            "friend_id" => 38548
        ]);

        $response->assertStatus(200);
    }

    public function testAddFriendFromAnotherGroup()
    {
        $response = $this->json('POST', 'api/addFriends', [
            "student_id" => 38546,
            "friend_id" => 38550
        ]);

        $response->assertStatus(422);
    }

    public function testCountOfFriendMoreThanTwo()
    {
        $response = $this->json('POST', 'api/addFriends', [
            "student_id" => 38546,
            "friend_id" => 38549
        ]);

        $response->assertStatus(422);
    }

    public function testDeleteFriend()
    {
        $response = $this->json('POST', 'api/deleteFriends', [
            "student_id" => 38546,
            "friend_id" => 38548
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteIncorrectFriend()
    {
        $response = $this->json('POST', 'api/deleteFriends', [
            "student_id" => 38546,
            "friend_id" => 66558
        ]);

        $response->assertStatus(422);
    }

    public function testShowFriends()
    {
        $response = $this->json('GET', 'api/showFriends', [
            "student_id" => 38546,
        ]);

        $response->assertStatus(200);
    }

    public function testShowFriendsIfThereIsNone()
    {
        $response = $this->json('GET', 'api/showFriends', [
            "student_id" => 38550,
        ]);

        $response->assertStatus(200);
    }

    public function testSearchFriendsIfThereIsNone()
    {
        $response = $this->json('GET', 'api/searchFriends', [
            "student_id" => 38546,
            "search" => "D"
        ]);

        $response->assertStatus(200);
    }
}

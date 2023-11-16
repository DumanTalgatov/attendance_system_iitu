<?php

namespace Tests\Unit;

use Tests\TestCase;

class ScheduleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testIsYearValidParameter(){
        $response = $this->get('api/getAttendanceForStudent/?year=2023');
        $response->assertStatus(200);
    }

    public function testIsMonthValidParameter(){
        $response = $this->get('api/getAttendanceForStudent/?month=9');
        $response->assertStatus(200);
    }

    public function testIsCourseIdValidParameter(){
        $response = $this->get('api/getAttendanceForStudent/?courseId=9');
        $response->assertStatus(200);
    }

    public function testIsYearInvalidParameter(){
        $response = $this->get('api/getAttendanceForStudent/?year=invalid_year');
        $response->assertStatus(422);
    }

    public function testIsMonthInvalidParameter(){
        $response = $this->get('api/getAttendanceForStudent/?month=13');
        $response->assertStatus(422);
    }

    public function testIsCourseIdInvalidParameter(){
        $response = $this->get('api/getAttendanceForStudent/?courseId=ggg');
        $response->assertStatus(422);
    }

    public function testResponseIsEmpty(){
        $response = $this->get('api/getAttendanceForStudent/?courseId=3');
        $response->assertStatus(200);
    }
}

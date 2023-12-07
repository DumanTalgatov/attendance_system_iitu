<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ExcuseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddExcuseCorrectly()
    {
        $file = UploadedFile::fake()->create('document.pdf', 1024);
        $response = $this->json("POST", "api/addExcuse", [
            "excuse_text" => "Some text",
            "excuse_type" => "Some type",
            "excuse_file" => $file,
            "excuse_date" => "2023-12-12",
            "student_id" => 38546
        ]);

        $response->assertStatus(200);
    }

    public function testAddExcuseIncorrectly()
    {
        $file = UploadedFile::fake()->create('document.pdf', 1024);
        $response = $this->json("POST", "api/addExcuse", [
            "excuse_text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut urna in leo tristique ullamcorper. Suspendisse potenti. Proin nec convallis libero. Phasellus et velit eu odio congue eleifend ac ac justo. Nunc pulvinar cursus leo, in aliquam turpis lacinia vitae. Maecenas eget tincidunt quam. Duis euismod quam quis nunc suscipit, a iaculis ex rhoncus. Integer euismod, odio sit amet tincidunt gravida, libero felis auctor nulla, at varius sapien orci ut justo. Sed tristique bibendum ultrices. Vivamus consectetur, leo sit amet posuere aliquet, tellus tortor tincidunt justo, a volutpat ex metus vel metus. Ut vel facilisis quam, a facilisis sem. Sed fringilla felis ac justo luctus, vel euismod libero ullamcorper. Sed ullamcorper urna vel dictum tempus. Phasellus at mauris in felis volutpat consequat. Vivamus vel interdum dui.",
            "excuse_type" => "Some type",
            "excuse_file" => $file,
            "excuse_date" => "2023-12-12",
            "student_id" => 38546
        ]);

        $response->assertStatus(422);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excuses', function (Blueprint $table) {
            $table->id();
            $table->string("excuse_text", 200)->nullable();
            $table->string("excuse_type");
            $table->string("excuse_file")->nullable();
            $table->date("excuse_date")->nullable();
            $table->unsignedBigInteger("student_id");
            $table->foreign("student_id")->references("student_id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excuses');
    }
};

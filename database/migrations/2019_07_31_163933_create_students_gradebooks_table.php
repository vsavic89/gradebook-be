<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsGradebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_gradebooks', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')
                ->foreign('id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
            $table->unsignedBigInteger('gradebook_id')
                ->foreign('id')
                ->references('id')
                ->on('gradebooks')
                ->onDelete('cascade');
            $table->timestamps();

            $table->primary(['student_id','gradebook_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_gradebooks');
    }
}

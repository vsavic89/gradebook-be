<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorsGradebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('imageUrl')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        Schema::create('gradebooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('numberOfStudents'); 
            $table->unsignedBigInteger('professor_id')
                ->foreign('id')
                ->references('id')
                ->on('professors')
                ->onDelete('cascade')->nullable();           
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professors');
        Schema::dropIfExists('gradebooks');
    }
}

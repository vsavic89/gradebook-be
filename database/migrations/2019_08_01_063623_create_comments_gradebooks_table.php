<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsGradebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_gradebooks', function (Blueprint $table) {
            $table->unsignedInteger('comment_id')
                ->foreign('id')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade');
            $table->unsignedInteger('gradebook_id')
            ->foreign('id')
            ->references('id')
            ->on('gradebooks')
            ->onDelete('cascade');
            $table->timestamps();

            $table->primary(['comment_id', 'gradebook_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments_gradebooks');
    }
}

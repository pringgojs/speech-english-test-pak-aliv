<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionAnswerVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answer_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->text('answer')->nullable();
            $table->integer('question_answer_id')->unsigned()->index();
            $table->foreign('question_answer_id')->references('id')->on('question_answers')->onDelete('cascade');
            $table->integer('score')->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('question_answer_variants');
    }
}

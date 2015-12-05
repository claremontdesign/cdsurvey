<?php

/**
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysQuestionsAnswerOptionsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/**
		 * Options of answers
		 */
		Schema::create(cd_config('database.surveys.answerOptions.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.answerOptions.table.primary'));
			$table->integer('answer_id')->nullable()->unsigned();
			$table->string('option_name')->nullable();
			$table->string('option_value')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('position')->nullable();
			$table->softDeletes();
			// $table->foreign('answer_id_id')->references(cd_config('database.surveys.answer.table.primary'))->on(cd_config('database.surveys.answer.table.name'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(cd_config('database.surveys.answerOptions.table.name'));
	}

}

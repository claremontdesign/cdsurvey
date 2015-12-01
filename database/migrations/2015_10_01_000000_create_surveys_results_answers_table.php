<?php

/**
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysResultsAnswersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/**
		 * Customers
		 */
		Schema::create(cd_config('database.surveys.resultAnswers.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.resultAnswers.table.primary'));
			$table->integer('result_id')->nullable();
			$table->integer('question_id')->nullable();
			$table->integer('answer_id')->nullable();
			$table->string('answer')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(cd_config('database.surveys.resultAnswers.table.name'));
	}

}

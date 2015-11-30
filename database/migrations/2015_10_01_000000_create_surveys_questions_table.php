<?php

/**
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysQuestionsTable extends Migration
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
		Schema::create(cd_config('database.surveysQuestions.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveysQuestions.table.primary'));
			$table->integer(cd_config('database.surveys.table.primary'))->nullable();
			$table->integer('question_set_id')->nullable();
			$table->string('title')->nullable();
			$table->text('description')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('position')->nullable();
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
		Schema::drop(cd_config('database.surveysQuestions.table.name'));
	}

}

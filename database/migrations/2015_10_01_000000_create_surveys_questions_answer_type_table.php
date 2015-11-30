<?php

/**
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysQuestionsAnswerTypeTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/**
		 * Questions can have multiple type of answers to be filled.
		 */
		Schema::create(cd_config('database.surveys.answer.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.answer.table.primary'));
			$table->integer('question_id')->nullable();
			$table->string('label')->nullable();
			$table->text('description')->nullable();
			$table->string('answer_type')->nullable();
			$table->boolean('required')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('position')->nullable();
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
		Schema::drop(cd_config('database.surveys.answer.table.name'));
	}

}

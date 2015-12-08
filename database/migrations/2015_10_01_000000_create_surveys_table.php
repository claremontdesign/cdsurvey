<?php

/**
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::dropIfExists(cd_config('database.surveys.answerOptions.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.answer.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.questionSet.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.questions.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.resultAnswers.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.result.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.surveys.table.name'));

		/**
		 * Surveys
		 */
		Schema::create(cd_config('database.surveys.surveys.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.surveys.table.primary'));
			$table->string('title')->nullable();
			$table->text('description')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('position')->nullable();
			$table->date('start_at');
			$table->date('end_at');
			$table->timestamps();
			$table->softDeletes();
		});

		/**
		 * Results
		 */
		Schema::create(cd_config('database.surveys.result.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.result.table.primary'));
			$table->integer(cd_config('database.surveys.surveys.table.primary'))->unsigned();
			$table->integer('customer_id')->nullable();
			$table->boolean('status')->nullable();
			$table->boolean('is_new')->nullable();
			$table->date('start_at');
			$table->date('end_at');
			$table->string('ip_address');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign(cd_config('database.surveys.surveys.table.primary'))
					->references(cd_config('database.surveys.surveys.table.primary'))
					->on(cd_config('database.surveys.surveys.table.name'))->onDelete('cascade');
		});

		/**
		 * Answers to each Question - Answerable fields
		 */
		Schema::create(cd_config('database.surveys.resultAnswers.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.resultAnswers.table.primary'));
			$table->integer(cd_config('database.surveys.result.table.primary'))->unsigned();
			$table->integer('question_id')->nullable();
			$table->integer('answer_id')->nullable();
			$table->string('answer')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign(cd_config('database.surveys.result.table.primary'))
					->references(cd_config('database.surveys.result.table.primary'))
					->on(cd_config('database.surveys.result.table.name'))->onDelete('cascade');
		});


		/**
		 * Survey Questions
		 */
		Schema::create(cd_config('database.surveys.questions.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.questions.table.primary'));
			$table->integer(cd_config('database.surveys.surveys.table.primary'))->unsigned();
			$table->integer('question_set_id')->nullable();
			$table->string('title')->nullable();
			$table->text('description')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('position')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign(cd_config('database.surveys.surveys.table.primary'))
					->references(cd_config('database.surveys.surveys.table.primary'))
					->on(cd_config('database.surveys.surveys.table.name'))->onDelete('cascade');
		});

		/**
		 * Set of Questions
		 */
		Schema::create(cd_config('database.surveys.questionSet.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.questionSet.table.primary'));
			$table->integer(cd_config('database.surveys.surveys.table.primary'))->unsigned();
			$table->string('title')->nullable();
			$table->text('description')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('position')->nullable();
			$table->softDeletes();
			$table->foreign(cd_config('database.surveys.surveys.table.primary'))
					->references(cd_config('database.surveys.surveys.table.primary'))
					->on(cd_config('database.surveys.surveys.table.name'))->onDelete('cascade');
		});

		/**
		 * Questions can have multiple answerable fields
		 * Answers
		 */
		Schema::create(cd_config('database.surveys.answer.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.answer.table.primary'));
			$table->integer(cd_config('database.surveys.questions.table.primary'))->unsigned();
			$table->string('label')->nullable();
			$table->text('description')->nullable();
			$table->string('answer_type')->nullable();
			$table->boolean('required')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('position')->nullable();
			$table->softDeletes();
			$table->foreign(cd_config('database.surveys.questions.table.primary'))
					->references(cd_config('database.surveys.questions.table.primary'))
					->on(cd_config('database.surveys.questions.table.name'))->onDelete('cascade');
		});

		/**
		 * Answers have multiple options
		 * Options for Select, checkboxes and Radio elements
		 */
		Schema::create(cd_config('database.surveys.answerOptions.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.answerOptions.table.primary'));
			$table->integer(cd_config('database.surveys.answer.table.primary'))->unsigned();
			$table->string('option_name')->nullable();
			$table->string('option_value')->nullable();
			$table->boolean('status')->nullable();
			$table->integer('position')->nullable();
			$table->softDeletes();
			$table->foreign(cd_config('database.surveys.answer.table.primary'))
					->references(cd_config('database.surveys.answer.table.primary'))
					->on(cd_config('database.surveys.answer.table.name'))->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists(cd_config('database.surveys.answerOptions.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.answer.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.questionSet.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.questions.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.resultAnswers.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.result.table.name'));
		Schema::dropIfExists(cd_config('database.surveys.surveys.table.name'));
	}
}

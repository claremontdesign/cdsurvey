<?php

/**
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysQuestionsSetTable extends Migration
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
		Schema::create(cd_config('database.surveysQuestionsSet.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveysQuestionsSet.table.primary'));
			$table->string(cd_config('database.surveys.table.primary'));
			$table->string('title')->nullable();
			$table->text('description')->nullable();
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
		Schema::drop(cd_config('database.surveysQuestionsSet.table.name'));
	}

}

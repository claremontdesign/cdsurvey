<?php

/**
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysResultsTable extends Migration
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
		Schema::create(cd_config('database.surveysResult.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveysResult.table.primary'));
			$table->integer('survey_id')->nullable();
			$table->integer('customer_id')->nullable();
			$table->integer('question_id')->nullable();
			$table->string('answer')->nullable();
			$table->boolean('status')->nullable();
			$table->date('start_at');
			$table->date('end_at');
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
		Schema::drop(cd_config('database.surveysResult.table.name'));
	}

}

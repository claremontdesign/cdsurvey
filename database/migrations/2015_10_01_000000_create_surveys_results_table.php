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
		Schema::create(cd_config('database.surveys.result.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.result.table.primary'));
			$table->integer('survey_id')->nullable();
			$table->integer('customer_id')->nullable();
			$table->boolean('status')->nullable();
			$table->boolean('is_new')->nullable();
			$table->date('start_at');
			$table->date('end_at');
			$table->string('ip_address');
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
		Schema::drop(cd_config('database.surveys.result.table.name'));
	}

}

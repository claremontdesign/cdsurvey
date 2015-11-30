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
		/**
		 * Customers
		 */
		Schema::create(cd_config('database.surveys.table.name'), function(Blueprint $table)
		{
			$table->increments(cd_config('database.surveys.table.primary'));
			$table->string('title')->nullable();
			$table->text('description')->nullable();
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
		Schema::drop(cd_config('database.surveys.table.name'));
	}

}

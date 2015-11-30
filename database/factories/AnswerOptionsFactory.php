<?php

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

$factory->define(cd_config('database.surveysQuestionsAnswerOptions.model.class'), function (Faker\Generator $faker) {
	$name = $faker->text(10);
	return [
		'option_name' => $name,
		'option_value' => $name,
		'status' => rand(1, 0),
		'position' => rand(1, 20),
	];
});

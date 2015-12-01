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

$factory->define(cd_config('database.surveys.questions.model.class'), function (Faker\Generator $faker) {
	return [
		'title' => $faker->text(150),
		'description' => $faker->text(150),
		'status' => 1,
		'position' => 1,
		'created_at' => $faker->date('Y-m-d'),
		'updated_at' => $faker->date('Y-m-d')
	];
});

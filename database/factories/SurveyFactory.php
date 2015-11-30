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

$factory->define(cd_config('database.surveys.surveys.model.class'), function (Faker\Generator $faker) {
	return [
		'title' => $faker->text(50),
		'description' => $faker->text(150),
		'status' => $faker->numberBetween(0, 1),
		'start_at' => $faker->date('Y-m-d'),
		'end_at' => $faker->date('Y-m-d'),
		'created_at' => $faker->date('Y-m-d'),
		'updated_at' => $faker->date('Y-m-d')
	];
});
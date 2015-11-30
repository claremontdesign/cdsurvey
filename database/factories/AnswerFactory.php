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

$factory->define(cd_config('database.surveys.answer.model.class'), function (Faker\Generator $faker) {
	$types = [
		'text',
		'numeric',
		'yesno',
		'date',
		'time',
		'datetime',
		'checkbox',
		'dropdownselect',
		'radioselect',
		'multipleselect'
	];
	return [
		'label' => $faker->text(50),
		'description' => $faker->text(150),
		'answer_type' => $types[rand(0, (count($types) - 1))],
		'required' => rand(0, 1),
		'status' => rand(0, 1),
		'position' => rand(1, 20),
	];
});

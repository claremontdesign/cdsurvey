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
		'textarea',
		'numeric',
		'date',
		'yesno',
		'radio',
		'checkbox'
	];
	return [
		'label' => $faker->text(50),
		'description' => $faker->text(150),
		'answer_type' => $types[rand(0, (count($types) - 1))],
		'required' => 1,
		'status' => 1,
		'position' => 1,
	];
});

<?php

use Illuminate\Database\Seeder;

class SurveyTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(cd_config('database.surveys.surveys.model.class'), 2)->make()->each(function($survey) {
			$survey->save();
			factory(cd_config('database.surveys.questions.model.class'), 2)->make()->each(function($question) use ($survey) {
				$question->survey()->associate($survey)->save();
				factory(cd_config('database.surveys.answer.model.class'), rand(2, 5))->make()->each(function($answer) use($question) {
					$answer->question()->associate($question)->save();
					$optionable = $answer->optionable();
					if($optionable)
					{
						factory(cd_config('database.surveys.answerOptions.model.class'), 4)->make()->each(function($option) use($answer) {
							$option->answer()->associate($answer)->save();
						});
					}
				});
			});
		});
	}

}

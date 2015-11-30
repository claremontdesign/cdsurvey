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
		factory(cd_config('database.surveys.surveys.model.class'), 2)->create()->each(function($survey) {
			if(!empty($survey))
			{
				factory(cd_config('database.surveys.questions.model.class'), rand(1, 10))->create()->each(function($question) use($survey) {
					if(!empty($question))
					{
						factory(cd_config('database.surveys.answer.model.class'), rand(1, 10))->create()->each(function($answer) use($question) {
							if($answer instanceof \Claremontdesign\Einkspread\Model\Survey\Answer)
							{
								$optionable = $answer->optionable();
								if(!empty($optionable))
								{
									factory(cd_config('database.surveys.answerOptions.model.class'), rand(1, 10))->create()->each(function($option) use($answer) {
										if($option instanceof \Claremontdesign\Einkspread\Model\Survey\AnswerOption)
										{
											$answer->options()->save($option);
										}
									});
								}
								$question->answers()->save($answer);
							}
						});
						$survey->questions()->save($question);
					}
				});
			}
		});
	}

}
